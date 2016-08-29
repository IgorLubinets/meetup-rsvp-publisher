( function($) {
	$(document).ready( function() {

	$('div[class^="meetup-rsvp-slides-"]').slick({
			centerMode: true,
  			centerPadding: '60px',
	  		slidesToShow: 3,
  			arrows: false,
			responsive: [
   	 	{
      		breakpoint: 1024,
      			settings: {
        			arrows: false,
        			centerMode: true,
        			centerPadding: '40px',
        			slidesToShow: 3
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
	});
})(jQuery);
