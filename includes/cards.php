<?php
/*
 *	Partial file to display RSVPs as tiled cards, called from inside the shortcode render function
 * Using masonry library
 */
?>
<div class="meetup-rsvp-publisher-cards">
	<?php
	$rsvpFieldOrder = get_option( 'webilect_meetup_rsvp_publisher_options_rsvp_field_order' );
	$showHideRsvpFields = (array)get_option( 'webilect_meetup_rsvp_publisher_options_show_hide_rsvp_fields_list' );

	foreach( $results as $item ) : ?> 
		<?php 
		$epoch = substr( ($item->time+$item->utc_offset), 0, 10);
		$new_time = new DateTime("@$epoch"); ?>
		
		<div class="meetup-rsvp-publisher-card-item">
			<div class="meetup-text">
			<?php 
			foreach( $rsvpFieldOrder as $currentField ) : ?> 
				
				<?php
				if( 'rsvp-fields-event-title' === $currentField && (false !== $showHideRsvpFields[$currentField])  ) : ?>
					<p class="<?php echo $currentField; ?>">
						<?php 
						echo $item->name; ?>
					</p>
				<?php
				elseif( 'rsvp-fields-hostedby' === $currentField && (false !== $showHideRsvpFields[$currentField])  ) : ?>	
					<p class="<?php echo $currentField; ?>">
						Hosted by 
						<?php 
						echo $item->group->name; ?> 
					</p>
				<?php
				elseif( 'rsvp-fields-date' === $currentField && (false !== $showHideRsvpFields[$currentField])  ) : ?>	
					<p class="<?php echo $currentField; ?>">
						<?php 
						echo $new_time->format('F j, Y, g:i a'); ?>
					</p>
				<?php
				elseif( 'rsvp-fields-address' === $currentField && (false !== $showHideRsvpFields[$currentField])  ) : ?>
					<p class="<?php echo $currentField; ?>">
						<?php 
						echo $item->venue->address_1; ?>, <?php echo $item->venue->city; ?>
					</p>	
				<?php elseif( 'rsvp-fields-details' === $currentField && (false !== $showHideRsvpFields[$currentField])  ) : ?>
					<p class="<?php echo $currentField; ?>">
						<a href="<?php echo $item->event_url;?>" rel="nofollow">Event Details...</a> 
					</p>
				<?php
				endif; ?>	
		
			<?php
			endforeach; ?>
			</div>
		</div>
	<?php
	endforeach;
	?>
</div>
