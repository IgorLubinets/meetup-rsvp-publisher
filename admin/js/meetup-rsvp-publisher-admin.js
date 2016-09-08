( function($) {
	$(document).ready( function() {

	$('.meetup-slides').slick({
  			centerPadding: '60px',
	  		slidesToShow: 4,
  			arrows: false,

			infinite: true,
			centerMode: true,

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

	//Duplicate, to try for the thickbox
	$('div[class^="meetup-rsvp-slides-"], .meetup-admin-preview-slides').slick({
	  		slidesToShow: 2,
  			arrows: false,
			infinite: true,
			centerMode: true,
/*			responsive: [
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
*/
		});
	
		//Hack the slider
		//Slick slider will not show if the element is hidden.  In this case
		//	the modal is hidden, so slick cannot calculate the proper dimensions.
		//		When you start dragging then it appears.  Otherwise width set to zero.
		//		This seems to work, need more testing!
		$('#show-preview').click( function() {
			$(window).trigger('resize');
		//	$('.meetup-admin-preview-slides').slick('unslick').slick('reinit');			
		//		console.log( 'Shortcode: ' + $('#shortCode').val() );
		
		//testing admin-ajax.php 
			var shortCodeValue = $('#shortCode').val();	
			var data = {
				action: 'webilect_rsvp_publish_ajax',
				shortcode: shortCodeValue,
			};	
			//console.log( 'Will Be Passing: ' + $('#shortCode').val() );
			
			$.post('http://192.241.196.100/wp-admin/admin-ajax.php', data, function( response ) {
				$('#shortcode-preview-slides').html(response);	
				//		$('.meetup-admin-preview-slides').slick('reinit');
				console.log( response );

			//REPETITION: move into a function!
			// or find a way to re-run on new html structure	
			$('div[class^="meetup-rsvp-slides-"]').slick({
		  		slidesToShow: 2,
  				arrows: false,
				infinite: true,
				centerMode: true,
			});
			//END REPETITION	

			});
		});

		//handle visibility toggle buttons
		$('span[id^="make-visible-"]').click( function() {
			$(this).css( 'display', 'none' );
			$(this).parent('div').find('span[id^="make-invisible-"]').css('display', 'block');		
			//$(this).closest('.meetup-item').css('opacity', '.35');
			$(this).closest('.meetup-item').addClass('grayout');
		});
		$('span[id^="make-invisible-"]').click( function() {
			$(this).css( 'display', 'none' );
		
//			$(this).closest('.meetup-item').css( 'opacity', '1' );
			$(this).closest('.meetup-item').removeClass('grayout');

			$(this).parent('div').find('span[id^="make-visible-"]').css('display', 'block');		
		});


	});
})(jQuery);
