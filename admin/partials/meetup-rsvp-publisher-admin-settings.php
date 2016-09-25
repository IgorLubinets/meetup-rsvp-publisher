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
		#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; max-width: 500px; margin: 0 auto; }
		#sortable li { margin: 0; padding: 0.4em; padding-left: 1.5em; padding-top: 15px; padding-bottom: 15px;
				font-size: 1.4em; height: 18px; border: 1px solid rgba(0,0,0,.2); text-align: left; cursor: move }
		#sortable li:hover { background: rgba(242,0,23, .78); color: white; }
		#sortable li span { position: absolute; margin-left: -1.3em; }
		#sortable li input[type="checkbox"] { margin: 0; padding: 0; margin-right: 20px; float: right; }
		#sortable li input[type="text"] { margin-left: 80px; position: absolute;  }
	</style>

	<h3>Drag to reorder fields</h3>

	<div style="border-radius: 20px; background-color: #f20017; 
					padding: 0; padding-top: 35px; padding-bottom: 20px; margin-left: 10px;
					width: 62%; max-width: 400px; text-align: center">
		<ul id="sortable" style="background: white">
			<li class="ui-state-default">Event Title<input type="checkbox" checked></li>
			<li class="ui-state-default">Hosted By<input type="checkbox" checked></li>
			<li class="ui-state-default">Date<input type="checkbox" checked></li>
			<li class="ui-state-default">
				<!--<span class="dashicons dashicons-move"></span>-->
				<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Address<input type="checkbox" checked></li>
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
