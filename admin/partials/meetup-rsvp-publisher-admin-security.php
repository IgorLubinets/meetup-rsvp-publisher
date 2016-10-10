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

	<h1>Meetup RSVP Publisher Security</h1>

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
		?>
		
		<?php
			$groups = Meetup_Rsvp_Publisher::$rsvps->getGroups();
		?>	
		
		<?php
/*		if( $_GET['authorized'] === 'no' && $_GET['settings-updated'] !== 'true') : */ ?>
		<?php
		if( $groups instanceof Exception ) : ?>
			<?php
			if( strpos( $groups->getMessage(), 'not_authorized' ) ) : ?> 	
				<div style="color: red; font-weight: 600; background-color: yellow; padding: 15px; margin: 15px; margin-left: 0">
					ATTENTION: please enter a valid Meetup.com API key
				</div>	
			<?php
			endif; ?>
		<?php
		endif;  ?>

		<?php
		submit_button();
		?>
	</form>
	


</div>
