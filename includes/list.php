<ul>
<?php
	//	var_dump( $results );	
	
	foreach( $results as $item ) : ?> 
		<li style="list-style-type: none; padding: 10px; background: rgba(0, 0, 0, .015);">
			<h3><?php echo $item->name; ?></h3>
			<hr>
		<!--	<p style="color: gray;">
				<?php// echo $item->status; ?> group id: <?php //echo $item->group->id; ?>
		 		Event ID: <?php //echo $item->id; ?>
			</p>
		-->	
			<?php 
				$epoch = substr( ($item->time+$item->utc_offset), 0, 10);
				$new_time = new DateTime("@$epoch"); ?>
			<p style="color: gray"><?php echo $new_time->format('F j, Y, g:i a'); ?></p>

			<p style="color: gray;">
				<?php echo $item->venue->address_1; ?>, <?php echo $item->venue->city; ?>
			</p>	
				
						<p>
				<a href="'<?php echo $item->event_url;?>'">Event Details...</a> 
			<!--<a href="'<?php //echo $item->event_url;?>'"><?php //echo $item->event_url; ?></a> -->	
			</p>

		</li>
	<?php
	endforeach;
	?>
</ul>
