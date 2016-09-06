( function($) {
	$(document).ready( function() {

	$('.meetup-slides').slick({
  			centerPadding: '60px',
	  		slidesToShow: 4,
  			arrows: false,
			infinite: false,
			responsive: [
  			{
	    			breakpoint: 1360,
      			settings: {
        			arrows: false,
        			centerMode: false,
        			centerPadding: '40px',
        			slidesToShow: 3 
		    		}
    		}, { breakpoint: 600,
      			settings: {
        			arrows: false,
        			centerMode: false,
        			centerPadding: '40px',
        			slidesToShow: 1
      			}
    		}
  			]
		});
		
		$('#prevSlide').click( function() {
			$('.meetup-slides').slick("slickPrev");
		});
		$('#nextSlide').click( function() {
			$('.meetup-slides').slick("slickNext");
		});

		//testing admin-ajax.php 
		var data = {
			action: 'webilect_rsvp_publish_ajax'
		};	
		$.post('http://192.241.196.100/wp-admin/admin-ajax.php', data, function( response ) {
			console.log( response );
		});


		//handle visibility toggle buttons
		$('span[id^="make-visible-"]').click( function() {
			$(this).css( 'display', 'none' );
			$(this).parent('div').find('span[id^="make-invisible-"]').css('display', 'block');		
			$(this).closest('.meetup-item').css('opacity', '.35');
		});
		$('span[id^="make-invisible-"]').click( function() {
			$(this).css( 'display', 'none' );
			$(this).closest('.meetup-item').css( 'opacity', '1' );
			$(this).parent('div').find('span[id^="make-visible-"]').css('display', 'block');		
		});


	});
})(jQuery);
