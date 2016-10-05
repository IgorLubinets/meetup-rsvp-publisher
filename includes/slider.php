<?php
/*
 *	Partial file to display RSVPs as a slick slider, using divs.  
 *	Called from inside the shortcode render function
 */
?>
<?php 
	//var_dump( $shortcode_Filters );
?>
<div class="meetup-rsvp-slides-<?php echo Meetup_RSVPS::$slidersCounter; ?> meetup-slides-container">
	<?php
	$rsvpFieldOrder = get_option( 'webilect_meetup_rsvp_publisher_options_rsvp_field_order' );
	$showHideRsvpFields = (array)get_option( 'webilect_meetup_rsvp_publisher_options_show_hide_rsvp_fields_list' );
	//	var_dump( $showHideRsvpFields );

	foreach( $results as $item ) : ?>

		<?php /*date voodoo */		
		$epoch = substr( ($item->time+$item->utc_offset), 0, 10);
		$new_time = new DateTime("@$epoch");
		?>

		<div class="meetup-item meetup-rsvp-publisher-slide">
			<div class="meetup-text">
			<?php
			foreach( $rsvpFieldOrder as $currentField ) : ?> 
				<?php 
				if( 'rsvp-fields-event-title' === $currentField && (false !== $showHideRsvpFields[$currentField]) ) : ?>
					<p class="<?php echo $currentField; ?>">
						<?php 
						echo $item->name ?>
					</p>
				<?php 
				elseif( 'rsvp-fields-hostedby' === $currentField && (false !== $showHideRsvpFields[$currentField]) ) : ?>
					<p class="<?php echo $currentField; ?>"
						style="font-size: small; text-align: left; margin: 0; padding-top: 0px">
						( hosted by <strong>  
							<?php 
							echo $item->group->name; ?>
						</strong> )
					</p>
				<?php
				elseif( 'rsvp-fields-date' === $currentField && (false !== $showHideRsvpFields[$currentField]) ) : ?>
					<p class="<?php echo $currentField; ?>"
						style="color: gray">
						<?php 
						echo $new_time->format('F j, Y, g:i a'); ?>
					</p>

				<?php
				elseif( 'rsvp-fields-address' === $currentField && (false !== $showHideRsvpFields[$currentField]) ) : ?>
					<a class="<?php echo $currentField; ?>"
						href="https://maps.google.com/?q=<?php echo $item->venue->lat; ?>,<?php echo $item->venue->lon; ?>">	
						<p class="<?php echo $currentField; ?>" style="color: gray;">
							<?php 
							echo $item->venue->address_1; ?>, <?php echo $item->venue->city; ?>
						</p>
					</a>
				<?php
				elseif( 'rsvp-fields-details' === $currentField && (false !== $showHideRsvpFields[$currentField]) ) : ?> 
					<p class="<?php echo $currentField; ?>">
						<a href="<?php echo $item->event_url;?>" rel="nofollow">Event Details...</a>	
					</p>
				<?php
				endif; ?>
			<?php
			endforeach; ?>
			</div><!-- end meetup-text -->
		</div>
	<?php endforeach; ?>
</div>

<?php 
	//increment for multiple sliders
	Meetup_RSVPS::$slidersCounter++;
