<?php
/**
 * Provide an admin page to handle the API key
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
		//Check the result of an API call to see if the key is valid.  
//		$groups = Meetup_Rsvp_Publisher::$rsvps->getGroups();
		?>	
	
		<?php
		//If the result is an exception, display a notification to the user
/*		if( $groups instanceof Exception ) : ?>
			<?php
			if( strpos( $groups->getMessage(), 'not_authorized' ) ) : ?> 	
				<div style="color: red; font-weight: 500; font-size: 1.2em; background-color: yellow; padding: 15px; margin: 15px; margin-left: 0">
					Please enter a valid Meetup.com API key. Get one <a href="https://secure.meetup.com/meetup_api/key/">here</a>
				</div>	
			<?php
			endif; ?>
		<?php
		endif; */ ?>

		<?php
		submit_button();
		?>
	</form>

</div>
