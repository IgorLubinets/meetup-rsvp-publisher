<div style="width: 95%; margin: 0 auto" class="meetup-rsvp-slides-<?php echo Meetup_RSVPS::$slidersCounter; ?>">

	<?php
	foreach( $results as $item ) : ?>
		<div class="meetup-item"
			 style="font-size: .8em; background-color: #f20017; padding: 0; 
				margin: 5px; box-shadow: 4px 4px 5px gray; width: 40%; float: left; border-radius: 20px; 
				margin-bottom: 25px; max-height: 470px">
<!--		<div id="<?php //echo $item->id; ?>" class="meetup-item"
			 style="font-size: .8em; background-color: #f20017; padding: 0; 
				margin: 5px; box-shadow: 4px 4px 5px gray; width: 40%; float: left; border-radius: 20px; margin-bottom: 25px">
-->

			<div class="meetup-text" style="background-color: white; min-height: 370px; margin-right: 0; margin-left: 0; 
					margin-top: 50px; margin-bottom: 30px; padding: 7px;">
				<h3> <?php echo $item->name ?></h3>
				<?php		/*date voodoo */		
					$epoch = substr( ($item->time+$item->utc_offset), 0, 10);
					$new_time = new DateTime("@$epoch");
				?>
				<p style="color: gray"><?php echo $new_time->format('F j, Y, g:i a'); ?></p>
				<p style="color: gray;"> 
				<?php 
					echo $item->status; ?> 
					group id: <?php echo $item->group->id; ?> 
					Event ID: <?php echo $item->id; ?>
				</p>	
				<p style="color: gray;">
				<?php 
					echo $item->venue->address_1; ?>, <?php echo $item->venue->city; ?>
				</p>	
				<a href="<?php echo $item->event_url;?>"><?php echo $item->event_url; ?></a>	
			</div>
		</div>
	<?php endforeach; ?>
</div>

<?php 
	Meetup_RSVPS::$slidersCounter++;
