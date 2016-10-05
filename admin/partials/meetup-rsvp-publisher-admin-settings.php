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

	<h3>Drag to reorder fields</h3>

	<div class="admin-rsvp-card-container">
		<ul id="sortable" style="background: white">

		<?php
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
