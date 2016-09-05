<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://igorcodes.com
 * @since      1.0.0
 *
 * @package    Meetup_Rsvp_Publisher
 * @subpackage Meetup_Rsvp_Publisher/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap" style="min-height: 900px">

	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<form action="options.php" method="post">
		<?php
		settings_fields( $this->plugin_name );
		do_settings_sections( $this->plugin_name );
		submit_button();
		?>
	</form>
	
	<?php
	//	$rsvps = new Meetup_RSVPS();
	$results = Meetup_Rsvp_Publisher::$rsvps->getLiveRSVPs();
	$return_value = '';
	//	date_default_timezone_set('America/Los_Angeles');	
	?>

	<hr>
	<div style="margin-bottom: 40px;">
		<span id="prevSlide" class="dashicons dashicons-arrow-left" style="font-size: 70px; color: #f20017;"></span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span id="nextSlide" class="dashicons dashicons-arrow-right" style="font-size: 70px; color: #f20017;"></span>
	</div>

	<div class="meetup-slides" style="width: 100%; margin: 0 auto;">
		<?php
		foreach( $results as $item ) {
		?>
			<div id="<?php echo $item->id; ?>" class="meetup-item"
				 style="font-size: .8em; background-color: #f20017; padding: 0; 
					margin: 5px; box-shadow: 4px 4px 5px gray; width: 40%; float: left; border-radius: 20px; margin-bottom: 25px">
						
				<div class="visibility-buttons-deck" style="padding: 5px">
					<span id="make-visible-<?php echo $item->id;?>" class="dashicons dashicons-visibility" 
						style="font-size: 45px; padding-top: 5px; padding-left: 20px; color: white"></span>
					<span id="make-invisible-<?php echo $item->id;?>" class="dashicons dashicons-hidden" 
						style="display: none; font-size: 45px; padding-top: 5px; padding-left: 20px; color: white"></span>
				</div>

				<div class="meetup-text" style="background-color: white; min-height: 230px; margin-right: 0; margin-left: 0; 
					margin-top: 50px; margin-bottom: 30px; padding: 7px;">
					<h2> <?php echo $item->name ?></h2>
					<?php		/*date voodoo */		
					$epoch = substr( ($item->time+$item->utc_offset), 0, 10);
					$new_time = new DateTime("@$epoch");
					?>
						<p style="color: gray"><?php echo $new_time->format('F j, Y, g:i a'); ?></p>
						<p style="color: gray;"> 
						<?php 
							echo $item->status; ?> 
							group id: <?php echo $item->group->id; ?> 
							Event ID: <?php echo $item->id; ?>
						</p>	
						<p style="color: gray;">
						<?php 
							echo $item->venue->address_1; ?>, <?php echo $item->venue->city; ?>
						</p>	
						<a href="<?php echo $item->event_url;?>"><?php echo $item->event_url; ?></a>	
					</div>
				</div>
			<?php
			}
			?>
	</div>

	<div style="clear:both"></div>	

	<?php
	//Shortcode string container pane ?>
	<div id="shortCode" style="background-color: white; padding: 20px;
			box-shadow: 1px 1px 3px gray; border-radius: 3px">
		<h3 style="padding-left: 10px">Shortcode Builder</h3>
		<textarea style="height: 120px; width: 80%; margin: 10px; margin-top: 5px; font-size: 30px" 
			placeholder="Your shortcode will show up here"></textarea> 
	</div>	

</div>
