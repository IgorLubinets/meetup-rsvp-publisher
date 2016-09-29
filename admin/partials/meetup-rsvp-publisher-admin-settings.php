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

<div class="wrap">

	<h1>Meetup RSVP Publisher Settings</h1>
	
	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher">Shortcode Builder</a>
		<a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-settings">Settings</a>	
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-documentation">Documentation</a>	
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-security">Security</a>	

	</h2>


	<?php //NOTE: Need to move styles out into a separate stylesheet file ?>

 	<style>
		.admin-rsvp-card-container { border-radius: 20px; background-color: #f20017; 
					padding: 0; padding-top: 35px; padding-bottom: 20px; margin-left: 10px;
					width: 62%; max-width: 400px; min-width: 290px; text-align: center; }
		#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; max-width: 400px; 
				min-width: 290px; margin: 0 auto; }
		#sortable li { margin: 0; padding: 0.4em; padding-left: 1.5em; padding-top: 20px; padding-bottom: 20px;
				font-size: 1.4em; height: 35px; border: 1px solid rgba(0,0,0,.2); text-align: left; cursor: move; 
				position: relative; }
		#sortable li:hover { background: rgba(242,0,23, .78); color: white; }
/*		#sortable li span { position: absolute; margin-left: -1.3em; } */
		#sortable li input[type="checkbox"] { margin: 0; padding: 0; margin-right: 20px; float: right; }
		#sortable li input[type="text"] { margin-left: 80px; position: absolute;  }
		.admin-rsvp-card-title { color: gray; position: absolute; top: 50%; transform: translateY(-50%); }
		.admin-rsvp-card-eyes { padding: 0px; font-size: 35px; text-align: center; margin: 0 auto; 
				color: gray; float: right; margin-right: 30px; } 
		.rsvp-fields-make-invisible { display: block }
		.rsvp-fields-make-visible { display: none }
	</style>

	<h3>Drag to reorder fields</h3>

	<div class="admin-rsvp-card-container">
		<ul id="sortable" style="background: white">

		<?php
		$rsvpFieldOrder = get_option( 'meetup-rsvp-publisher_rsvp_field_order' );
		$showHideRsvpFields = (array)get_option( 'webilect_meetup_rsvp_publisher_options_show_hide_rsvp_fields_list' );
		var_dump($showHideRsvpFields);

		foreach( $rsvpFieldOrder as $currentField ) : ?>
			<?php 

		//	echo 'current field= ' . $currentField;

			if( isset($showHideRsvpFields[$currentField]) ) {
				$showHideFlag = $showHideRsvpFields[$currentField];
			}
			else {
				$showHideFlag = true;
			}
			//echo 'currentField=' . $currentField . ': ' . $showHideFlag;
			
			if( 'rsvp-fields-event-title' === $currentField ) : ?>
				<li id="rsvp-fields-event-title" class="ui-state-default	<?php echo( ( false === $showHideFlag ) ? ' grayout ' : '' ); ?>">
					<span class="admin-rsvp-card-title">Event Title</span>
					<span class="dashicons dashicons-visibility admin-rsvp-card-eyes rsvp-fields-make-<?php echo( (false === $showHideFlag) ? 'visible' : 'invisible' ); ?>"></span>
					<span class="dashicons dashicons-hidden admin-rsvp-card-eyes rsvp-fields-make-<?php echo( (false === $showHideFlag) ? 'invisible' : 'visible' ); ?>"></span>
				</li>
			<?php 
			elseif( 'rsvp-fields-hostedby' === $currentField ) : ?>	
				<li id="rsvp-fields-hostedby" class="ui-state-default	<?php echo( ( false === $showHideFlag ) ? ' grayout ' : '' ); ?>">
					<span class="admin-rsvp-card-title">Hosted by</span>
					<span class="dashicons dashicons-visibility admin-rsvp-card-eyes rsvp-fields-make-<?php echo( ( false === $showHideFlag ) ? 'visible' : 'invisible' ); ?>"></span>
					<span class="dashicons dashicons-hidden admin-rsvp-card-eyes rsvp-fields-make-<?php echo( ( false === $showHideFlag ) ? 'invisible' : 'visible' ); ?>"></span>
				</li>
			<?php
			elseif( 'rsvp-fields-date' === $currentField ) : ?>
				<li id="rsvp-fields-date" class="ui-state-default <?php echo( ( false === $showHideFlag ) ? ' grayout ' : '' ); ?>">
					<span class="admin-rsvp-card-title">Date</span>
					<span class="dashicons dashicons-visibility admin-rsvp-card-eyes rsvp-fields-make-<?php echo( ( false === $showHideFlag ) ? 'visible' : 'invisible' ); ?>"></span>
					<span class="dashicons dashicons-hidden admin-rsvp-card-eyes rsvp-fields-make-<?php echo( ( false === $showHideFlag ) ? 'invisible' : 'visible' ); ?>"></span>
				</li>
			<?php 
			elseif( 'rsvp-fields-address' === $currentField ) : ?>		
				<li id="rsvp-fields-address" class="ui-state-default <?php echo( ( false === $showHideFlag ) ? ' grayout ' : '' ); ?>">
					<span class="admin-rsvp-card-title">Address</span>
					<span class="dashicons dashicons-visibility admin-rsvp-card-eyes rsvp-fields-make-<?php echo( ( false === $showHideFlag ) ? 'visible' : 'invisible' ); ?>"></span>
					<span class="dashicons dashicons-hidden admin-rsvp-card-eyes rsvp-fields-make-<?php echo( ( false === $showHideFlag ) ? 'invisible' : 'visible' ); ?>"></span>
				</li>
			<?php
			elseif ( 'rsvp-fields-details' === $currentField ) : ?> 
				<li id="rsvp-fields-details" class="ui-state-default <?php echo( ( false === $showHideFlag ) ? ' grayout ' : '' ); ?>">
					<span class="admin-rsvp-card-title">Details</span>
					<span class="dashicons dashicons-visibility admin-rsvp-card-eyes rsvp-fields-make-<?php echo( ( false === $showHideFlag ) ? 'visible' : 'invisible' ); ?>"></span>
					<span class="dashicons dashicons-hidden admin-rsvp-card-eyes rsvp-fields-make-<?php echo( ( false === $showHideFlag ) ? 'invisible' : 'visible' ); ?>"></span>
				</li>
			<?php 
			endif; ?>
			<?php 
				//reset the flag
				$showHideFlag = '';
			?>	
		<?php
		endforeach; ?>
	
		</ul>
	</div>

	<form action="options.php" method="post">
		<?php
		settings_fields( $this->plugin_name );
		do_settings_sections( $this->plugin_name );
		submit_button();
		?>
	</form>

</div>
