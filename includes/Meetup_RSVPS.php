<?php
/**
 * Construct RSVP list using filters
 *
 * @package Meetup-RSVPs-Publisher
 *
 *
 */
include( plugin_dir_path( __FILE__ ) . 'Meetup-master/meetup.php' );

class Meetup_RSVPS {
	
	private $credentials = [];	
	private $filters = [];
	public static $slidersCounter = 1; //for multiple sliders
	public $error = false; //error flag

	function __construct() {
	//	$options = get_option( 'webilect_meetup_stalker_options' );

/*		if( !isset($key) ) {
			$key = get_option('webilect_meetup_rsvp_publisher_options_api_key_value');
		}
*/	
		$this->credentials = array(
			'key'					=>	get_option('webilect_meetup_rsvp_publisher_options_api_key_value'),
//			'key'					=> $key,
			'rsvp'				=>	'yes',
			'member_id'			=> 'self' );
		$slidersCounter = 1;

//		echo 'Constructor done';

		//echo 'Dumping filters from constructor->';
		//var_dump( $this->filters );		
	 	
		//Define Filter
		add_filter( 'meetup_RSVP_filter', array( $this, 'filter_RSVPs') );
	}
	
	/** 
	 * Gets ALL the RSVPs, live raw data from the Meetup API 
	 * @return array json object containing a fresh list of RSVPs
	*/
	public function getLiveRSVPs() {
		try {
			$rsvps = ( new Meetup($this->credentials) )->getEvents(); 	
//			echo '<h2>Querying Live Server...</h2>';
		} 
		catch ( \Exception $exception ) {
			//display error only to admin users
			if( is_admin() ) { 
				echo 'Exception caught!!!';
				echo $exception->getMessage();
				if( strpos( $exception->getMessage(), 'not_authorized' ) ) {
					echo '<h2>Wrong Key!</h2>';
				}
			}

			$this->error=true;
			return;
		}
//		var_dump( $rsvps->results );
		return $rsvps->results;
	}

	/** 
	 * Pull only CACHED RSVPs from the database 
	 * @return array json object containing a list of cached RSVPs
	*/
	public function getCachedRSVPs() {
		// HACK:		
		//	delete_transient( 'webilect_meetup_rsvps' );
		// had to do it, because once I set the transient to 0 ( to never expire )
		// it got stuck, never updating! BUG?

		/*
			Maybe a little paranoid, but just had a problem where transient got set to 
			never expire. So, need to filter the zero out
		 */
		$transient_value = get_option('webilect_meetup_rsvp_publisher_options_transient_value');
		if( $transient_value === false ) {
			delete_transient( 'webilect_meetup_rsvps' );
		}	
		$rsvps = get_transient( 'webilect_meetup_rsvps' );

		if( false === $rsvps ) {
			echo '<h2>No Transient, going live...</h2>';
			$rsvps = $this->getLiveRSVPs();
			set_transient( 'webilect_meetup_rsvps', $rsvps, ( ($transient_value === false) ? 15 : $transient_value )  ); 
		}
			
		return apply_filters('meetup_RSVP_filter', $rsvps);
	}

	/**
	 * Utility function to get a list of Groups
	 * @return array list of groups, or if error, returns exception object
	 */	
	public function getGroups( array $parameters = array() ) {
		
		$rsvps = get_transient( 'webilect_meetup_rsvps_groups' );
		
		if( false === $rsvps ) {
			try {
				$rsvps = ( new Meetup($this->credentials) )->getGroups( $parameters ); 	
			} 
			catch ( \Exception $exception ) {
				$this->error=true;
				return $exception;
			}
			set_transient( 'webilect_meetup_rsvps_groups', $rsvps, 1 ); //hardcoded, store it for 60 seconds 
		}
		return $rsvps;
	}

	/**
	 * Utility function to check if the API Key is valid
	 * @return boolean: true if valid, false for invalid 
	 */
	public function isKeyValid( $key ) {
		try {
			$rsvps = ( new Meetup( array( 
				'key' 			=> $key,
				'rsvp'			=>	'yes',
				'member_id'		=> 'self' )	) )->getGroups(); 	
		} 
		catch ( \Exception $exception ) {
			if( strpos( $exception->getMessage(), 'not_authorized' ) ) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Filter function to process the shortcode filters 
	 *
	 * @return array json object containing the list of "filtered" RSVPs
	*/
	public function filter_RSVPs( $data ) {
	//	echo '<h1>Filtering...</h1>';	
		//echo '<br>Dumping filters from the filter_RSVPs function';
		//var_dump( $this->filters );

//		var_dump( $data );

		$temp = [];

		if( $this->filters && !empty($data) ) {
			foreach( $data as $rsvp ) {
				if( isset( $this->filters['show'] ) && strtolower($this->filters['show']) === 'all' ) {
					//echo "showing: " . $this->filters['show'] . "<br>";
					if( isset( $this->filters['hidegroups'] ) ) {
						//echo "hide groups: " . $this->filters['hidegroups'];
						$hide_groups = explode( " ", $this->filters['hidegroups'] );
						if( 1 < count($hide_groups) ) {
							if( !in_array( $rsvp->group->id, $hide_groups ) ) {
								$temp[] = $rsvp;
							}
						}
						else {
							//echo "one group to hide";
							if( $rsvp->group->id !== (int)( $this->filters['hidegroups'] ) ) {
								$temp[] = $rsvp;
							} 
						}
					}
					else {
						$temp[] = $rsvp;
					}
				}
				if( isset( $this->filters['hide'] ) && strtolower($this->filters['hide']) === 'all' ) {
					if( isset( $this->filters['showgroups'] ) ) {
						$show_groups = explode( " ", $this->filters['showgroups'] );
						if( 1 < count($show_groups) ) {
							if( in_array( $rsvp->group->id, $show_groups ) ) {
								$temp[] = $rsvp;
							}
						} else
							if( $rsvp->group->id === (int)( $this->filters['showgroups'] ) ) {
								$temp[] = $rsvp;
						}
					}
				}
				//if show or hide not specified, use show="all" as default
				// was a problem in the case of [meetup-rsvp-publisher display="layout" /]
				if( ! isset( $this->filters['show'] ) && ! isset( $this->filters['hide'] ) ) {
					$temp[] = $rsvp;	
				}

			}
		} else {
			return $data;
		}
		
		//echo 'Dumping from inside filter function...';
		//var_dump ($temp);
		return $temp;
	}
	
	/**
	 * Utility function to set the filters array from the shortcode
	 *
	*/
	public function setFilters( $shortcode_Filters ) {
		$this->filters = $shortcode_Filters;
		//var_dump( $this->filters );
	}

}
