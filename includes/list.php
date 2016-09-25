<ul class="meetup-rsvp-publisher-list">
	<?php
	foreach( $results as $item ) : ?> 
	<li>
		<h3><?php echo $item->name; ?></h3>
		<?php 
		$epoch = substr( ($item->time+$item->utc_offset), 0, 10);
		$new_time = new DateTime("@$epoch"); ?>
		<p>
			<?php 
			echo $new_time->format('F j, Y, g:i a'); ?>
		</p>
		<p>
			<?php 
			echo $item->venue->address_1; ?>, <?php echo $item->venue->city; ?>
		</p>	
		<p>
			<a href="'<?php echo $item->event_url;?>'">Event Details...</a> 
		</p>
	</li>
	<?php
	endforeach;
	?>
</ul>
