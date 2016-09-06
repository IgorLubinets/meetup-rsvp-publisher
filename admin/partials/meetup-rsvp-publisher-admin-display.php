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

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher">Shortcode Builder</a>
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-settings">Settings</a>	
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-documentation">Documentation</a>	

	</h2>

	<?php
	$groups = Meetup_Rsvp_Publisher::$rsvps->getGroups();
	$return_value = '';
	//var_dump( $groups);
	?>
<div style="width: 100%; ">
	
	<div style="margin-bottom: 40px;">
		<span id="prevSlide" class="dashicons dashicons-arrow-left" style="margin-right: 35px; font-size: 70px; color: #f20017;"></span>
		<span id="nextSlide" class="dashicons dashicons-arrow-right" style="font-size: 70px; color: #f20017;"></span>
	</div>

	<div class="meetup-slides">
		<?php
		foreach( $groups->results as $item ) {
		?>
			<div id="<?php echo $item->id; ?>" class="meetup-item"
				 style="background-color: #f20017; padding: 0; 
					margin: 5px; box-shadow: 4px 4px 5px gray; width: 40%; float: left; border-radius: 20px; margin-bottom: 25px">
						
				<div class="visibility-buttons-deck" style="padding: 5px; height: 25px;">
					<span id="make-visible-<?php echo $item->id;?>" class="dashicons dashicons-visibility" 
						style="font-size: 45px; padding-top: 5px; padding-left: 20px; color: white"></span>
					<span id="make-invisible-<?php echo $item->id;?>" class="dashicons dashicons-hidden" 
						style="display: none; font-size: 45px; padding-top: 5px; padding-left: 20px; color: white"></span>
				</div>

				<div class="meetup-text" style="background-color: white; min-height: 250px; margin-right: 0; margin-left: 0; 
					margin-top: 40px; margin-bottom: 10px; padding: 15px;">
					<h2><?php echo $item->name; ?></h2>
					<strong>Visibility: </strong><?php echo $item->visibility; ?>
					<p><?php echo $item->members; ?> members</p>
					<p><?php echo $item->city; ?>, <?php echo $item->state; ?></p>
					<a href="<?php echo $item->link; ?>">Details</a>
				</div>
				<div style="color: white; height: 35px; padding: 0; 
					font-weight: bold; margin: 0 auto; text-align: center;">
					Group ID: <?php echo $item->id; ?>
				</div>
			</div>
		
			<?php
			}
			?>
	</div>

</div>
	<div style="clear:both"></div>	

	<?php
	//Shortcode string container pane ?>
	<div id="shortCode" style="background-color: white; padding: 20px;
			box-shadow: 1px 1px 3px gray; border-radius: 3px">
		<h3 style="padding-left: 10px">Ready Shortcode</h3>
		<textarea style="height: 120px; width: 80%; margin: 10px; margin-top: 5px; font-size: 30px" 
			placeholder="Your shortcode will show up here"></textarea> 

		<div style="float: right; width: 16%">
			<input type="submit" class="button button-primary" style="font-size: 1.3em; width: 110px; height: 50px" value="Preview"><br><br>
			<input type="submit" class="button button-secondary" style="width: 110px; height: 35px" value="Set As Default">		
		</div>

	</div>	

</div>
