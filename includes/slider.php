<?php 
//var_dump( $shortcode_Filters );
?>
<div class="meetup-rsvp-slides-<?php echo Meetup_RSVPS::$slidersCounter; ?> meetup-slides-container">
	<?php
	foreach( $results as $item ) : ?>
		<div class="meetup-item meetup-rsvp-publisher-slide">
			 <div class="meetup-text">
				<h3>
					<?php 
					echo $item->name ?>
				</h3>
				<p style="font-size: small; text-align: left; margin: 0; padding-top: 0px">(hosted by <em>  
					<?php 
					echo $item->group->name; ?></em>)
				</p>
				<p>	
					<?php		/*date voodoo */		
					$epoch = substr( ($item->time+$item->utc_offset), 0, 10);
					$new_time = new DateTime("@$epoch");
					?>
				</p>
				<p style="color: gray">
					<?php 
					echo $new_time->format('F j, Y, g:i a'); ?>
				</p>
				<a href="https://maps.google.com/?q=<?php echo $item->venue->lat; ?>,<?php echo $item->venue->lon; ?>">	
					<p style="color: gray;">
						<?php 
						echo $item->venue->address_1; ?>, <?php echo $item->venue->city; ?>
					</p>
				</a>
				<p>
					<a href="<?php echo $item->event_url;?>">Event Details...</a>	
				</p>
			</div><!-- end meetup-text -->
		</div>
	<?php endforeach; ?>
</div>

<?php 
	//increment for multiple sliders
	Meetup_RSVPS::$slidersCounter++;
