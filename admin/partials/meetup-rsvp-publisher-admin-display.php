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
		<a class="nav-tab" href="<?php echo admin_url() ?>options-general.php?page=meetup-rsvp-publisher-security">Security</a>	
	</h2>

	<?php
	//Handle the wrong API key situation, if the key is invalid, redirect to the Security page to enter the new one
	$groups = Meetup_Rsvp_Publisher::$rsvps->getGroups();
	$return_value = '';
	
	if( $groups instanceof Exception ) {
		if( strpos( $groups->getMessage(), 'not_authorized' ) ) {
      	$redirect_script = '<script type="text/javascript">';
         $redirect_script .= 'window.location = "' . admin_url()
            . 'options-general.php?page=meetup-rsvp-publisher-security&authorized=no"' ;
         $redirect_script .= '</script>';
         echo $redirect_script;
      }
	}
	?>

<div style="width: 100%; margin-top: 20px; margin-bottom: 30px">
	
	<!--	
	<div style="margin-bottom: 40px;">
		<span id="prevSlide" class="dashicons dashicons-arrow-left" style="margin-right: 35px; font-size: 70px; color: #f20017;"></span>
		<span id="nextSlide" class="dashicons dashicons-arrow-right" style="font-size: 70px; color: #f20017;"></span>
	</div>
	-->
	<h1 class="admin-header">1) Pick Visibility</h1>
	<div style="margin: 25px; font-size: 1.4em; color: #f20017; width: 30%; float: left; max-width: 300px">
		<label style="margin: 15px; margin-right: 30px"><input type="radio" id="allStatusShow" name="allStatus" value="show" checked>Show All</label>
		<label style="margin: 15px"><input type="radio" id="allStatusHide" name="allStatus" value="hide">Hide All</label>
	</div>
<!--	<div style="width: 10%; float: left; padding: 10px">
		<button id="allStatusReset" value="Reset" class="button button-primary" 
			style="font-size: 17px; height: 50px">
			Builder Reset 
		</button>
	</div>
-->
	<div style="clear:both"></div>	

	<h1 class="admin-header">2) Pick Your Groups ( click the <span class="dashicons dashicons-visibility" style="padding: 5px; text-decoration: none"></span>  icon)</h1>

	<span id="prevSlide" class="dashicons dashicons-arrow-left"></span>

	<div class="meetup-slides">
		<?php
		foreach( $groups->results as $item ) {
		?>
			<div id="<?php echo $item->id; ?>" class="meetup-item admin-meetup-item">
				<div class="visibility-buttons-deck">
					<span id="make-visible-<?php echo $item->id;?>" class="dashicons dashicons-visibility" 
						style="font-size: 45px; padding-top: 5px; color: white; margin: 0 auto; text-align: center; width: auto"></span>
					<span id="make-invisible-<?php echo $item->id;?>" class="dashicons dashicons-hidden" 
						style="display: none; font-size: 45px; padding-top: 5px; color: white; text-align: center; margin: 0 auto; width: auto;"></span>
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

	<span id="nextSlide" class="dashicons dashicons-arrow-right"></span>


</div>
	<div style="clear:both"></div>	
	
	<?php 
	add_thickbox(); ?>

	<h1 class="admin-header">3) Get the Shortcode</h1>
	<?php
	//Shortcode string container pane ?>
	<div style="background-color: white; padding: 20px; 
			box-shadow: 1px 1px 3px gray; border-radius: 3px">

		<div style="margin: 0; padding-bottom: 15px; font-size: 1.4em; color: #f20017; width: 50%; float: left; max-width: 450px">
			<label style="margin: 15px; margin-right: 30px"><input type="radio" id="pickSlider" name="pickLayout" value="slider">Slider</label>
			<label style="margin: 15px; margin-right: 30px"><input type="radio" id="pickCards" name="pickLayout" value="cards">Cards</label>
			<label style="margin: 15px; margin-right: 30px"><input type="radio" id="pickList" name="pickLayout" value="list">List</label>
			<label style="margin: 15px"><input type="radio" id="useDefault" name="pickLayout" value="default" checked>Default</label>
		</div>
		<div style="clear:both"></div>	


		<textarea id="shortCode" placeholder="Your shortcode will show up here">[meetup-rsvp-publisher /]</textarea> 

		<div style="float: left; padding: 15px; padding-top: 5px;">
			<a id="show-preview" class="thickbox"
				href="#TB_inline?width=900&height=600&inlineId=shortcode-preview">
				<input type="submit" class="button button-primary" style="font-size: 1.3em; width: 110px; height: 50px" value="Preview">
			</a>
			<br><br>
			<!--<input id="set-as-default" type="submit" class="button button-secondary" 
				style="width: 110px; height: 35px" value="Set As Default">		
			-->
			<button id="allStatusReset" value="Reset" class="button button-secondary" 
				style="font-size: 14px; height: 50px">
				Builder Reset 
			</button>

		</div>

	</div>	

	<?php 
	//Creates modal (thick-box) ?>
	<div id="shortcode-preview" style="display: none">
		<h1 style="font-size: 3em;">
			Live Preview	
		</h1>
		<div id="shortcode-preview-slides">
			<?php //echo do_shortcode('[meetup-rsvp-publisher show="all" display="slider" admin_preview="true" /]'); ?>
			<?php echo do_shortcode('[meetup-rsvp-publisher /]'); ?>
		</div>
	</div>

</div>
