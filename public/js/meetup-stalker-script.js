(function($){
   $(document).ready( function($) {
      $(".meetup-item").draggable();
 		
		$("#drop-here").droppable( {
			drop: function( event, ui ) {
				console.log("Item dropped!");
				var itemDragged = $(ui.draggable).attr('id');
				$(this).append('<div style="margin: 10px; background-color: white; width: 40%; float: left; box-shadow: 4px 4px 4px gray; padding: 5px">' + ui.draggable.html() + '</div>');
				ui.draggable.remove();
			}
		});

	});

})(jQuery);


