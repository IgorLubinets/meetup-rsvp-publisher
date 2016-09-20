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

	<h1>Meetup RSVP Publisher API Key</h1>

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher">Shortcode Builder</a>
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-settings">Settings</a>	
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-documentation">Documentation</a>	
		<a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-security">Security</a>	

	</h2>

	<form action="options.php" method="post">
		<?php
		settings_fields( $this->plugin_name . '_security_key' );
		do_settings_sections( $this->plugin_name . '-security' );
		submit_button();
		?>
	</form>

</div>
