<ul class="meetup-rsvp-publisher-list">
	<?php
	$rsvpFieldOrder = get_option( 'meetup-rsvp-publisher_rsvp_field_order' );
	foreach( $results as $item ) : ?> 
		<?php 
		$epoch = substr( ($item->time+$item->utc_offset), 0, 10);
		$new_time = new DateTime("@$epoch"); ?>
		
		<li>

			<?php 
			foreach( $rsvpFieldOrder as $currentField ) : ?> 
				<?php
				if( 'rsvp-fields-event-title' === $currentField ) : ?>
					<p class="<?php echo $currentField; ?>">
						<?php 
						echo $item->name; ?>
					</p>
				<?php
				elseif( 'rsvp-fields-hostedby' === $currentField ) : ?>	
					<p class="<?php echo $currentField; ?>">
						Hosted by 
						<?php 
						echo $item->group->name; ?> 
					</p>
				<?php
				elseif( 'rsvp-fields-date' === $currentField ) : ?>	
					<p class="<?php echo $currentField; ?>">
						<?php 
						echo $new_time->format('F j, Y, g:i a'); ?>
					</p>
				<?php
				elseif( 'rsvp-fields-address' === $currentField ) : ?>
					<p class="<?php echo $currentField; ?>">
						<?php 
						echo $item->venue->address_1; ?>, <?php echo $item->venue->city; ?>
					</p>	
				<?php elseif( 'rsvp-fields-details' === $currentField ) : ?>
					<p class="<?php echo $currentField; ?>">
						<a href="'<?php echo $item->event_url;?>'">Event Details...</a> 
					</p>
				<?php
				endif; ?>	
		
			<?php
			endforeach; ?>

		</li>
	<?php
	endforeach;
	?>
</ul>
