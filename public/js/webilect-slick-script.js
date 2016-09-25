( function($) {
	$(document).ready( function() {

	$('div[class^="meetup-rsvp-slides-"]').slick({
			centerMode: true,
  		//	centerPadding: '60px',
	  		slidesToShow: 2,
  			arrows: false,
			infinite: true,
			swipeToSlide: true,
			centerPadding: '50px',
			autoplay: true,
			responsive: [
   	 	{
      		breakpoint: 1024,
      			settings: {
        			arrows: false,
        			centerMode: true,
        			centerPadding: '40px',
        			slidesToShow: 2 
      		}
    		},
    		{
      		breakpoint: 600,
      			settings: {
        			arrows: false,
        			centerMode: true,
        			centerPadding: '40px',
        			slidesToShow: 1
      		}
    		}
  			]
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
