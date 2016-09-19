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
<div class="wrap">

	<h1>Meetup RSVP Publisher Settings<h1>

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher">Shortcode Builder</a>
		<a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-settings">Settings</a>	
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-documentation">Documentation</a>	
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-security">Security</a>	

	</h2>

	<form action="options.php" method="post">
		<?php
		settings_fields( $this->plugin_name );
		//settings_fields( $this->plugin_name . '_rsvp_field_list' );
		do_settings_sections( $this->plugin_name );
		submit_button();
		?>
	</form>

 	<style>
		#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; max-width: 320px; margin: 0 auto; }
		#sortable li { margin: 0; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; border: 1px solid gray; text-align: left }
		#sortable li span { position: absolute; margin-left: -1.3em; }
		#sortable li input[type="checkbox"] { margin: 0; padding: 0; margin-right: 20px; float: right; }
	</style>
	<div style="border-radius: 20px; background-color: #f20017; 
					padding: 0; padding-top: 35px; padding-bottom: 20px;
					width: 62%; max-width: 320px; text-align: center">
		<ul id="sortable" style="background: white">
			<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Event Title<input type="checkbox" checked></li>
			<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Event Host<input type="checkbox" checked></li>
			<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Event Date<input type="checkbox" checked></li>
			<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Event Address<input type="checkbox" checked></li>
			<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Map Link<input type="checkbox" checked></li>
		</ul>
	</div>




</div>
