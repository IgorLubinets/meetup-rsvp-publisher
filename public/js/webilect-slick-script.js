( function($) {
	$(document).ready( function() {
	
		$('div[class^="meetup-rsvp-slides-"]').each( function() {
			console.log( 'width', $(this).width());	
			var numberOfSlides = ( $(this).width() > 400 ) ? 2 : 1; 

			if( $(this).width() < 400 ) {
				$(this).slick({
					centerMode: true,
	  				slidesToShow: 1,
  					arrows: false,
					infinite: true,
					swipeToSlide: true,
					centerPadding: '50px',
					autoplay: true,
				}); 
			} else {
				$(this).slick({
					centerMode: false,
	  				slidesToShow: 3,
  					arrows: false,
					infinite: true,
					swipeToSlide: true,
					centerPadding: '50px',
					autoplay: true,
				}); 
			}
		});

		//testing admin-ajax.php 
		var data = {
			action: 'webilect_rsvp_publish_ajax'
		};	
		$.post('http://192.241.196.100/wp-admin/admin-ajax.php', data, function( response ) {
			console.log( response );
		});

	});
})(jQuery);
