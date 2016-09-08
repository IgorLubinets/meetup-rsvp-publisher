( function($) {
	$(document).ready( function() {

	//Shortcode object 
	var shortCode = new Object; 
	shortCode['allStatus'] = $('input[name="allStatus"]:checked').val();
	console.log('INITIAL: CHeCKBOX SET TO: ' + shortCode['allStatus'] );

	$('.meetup-slides').slick({
  			centerPadding: '60px',
	  		slidesToShow: 4,
  			arrows: false,

		//	infinite: true,
		//	centerMode: true,

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
	//	$('.meetup-slides').slick('reinit');
	//	$(window).trigger('resize');

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
			console.log('Clicked the eye');	
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


		//Code to handle ShowAll HideAll radio buttons 
		/////////////////////////////////////////////////////////////////////
		$('#allStatusShow').click( function() {
			if( shortCode['allStatus'] !== 'show' ) {
				toggleEye();
				shortCode['allStatus'] = 'show';
			}
			
		});	
		$('#allStatusHide').click( function() {
			if( shortCode['allStatus'] !== 'hide' ) {
				toggleEye();
				shortCode['allStatus'] = 'hide';	
			}
		});	

	
		function toggleEye() {
			$('.meetup-item').each( function() {
				if( $(this).hasClass('grayout') ) {
					$('span[id^="make-visible-"]', this).css('display', 'block');
					$('span[id^="make-invisible-"]', this).css('display', 'none');
					$(this).removeClass('grayout');
				} else {
					$('span[id^="make-invisible-"]', this).css('display', 'block');
					$('span[id^="make-visible-"]', this).css('display', 'none');
					$(this).addClass('grayout');
				}
			});	
			$('div[class^="meetup-rsvp-slides-"]').slick('unslick').slick('reinit');
		
		}

		/////////////////////////////////////////////////////////////////////
		//End Code to handle creation of the Shortcode string
		
	
	});
})(jQuery);
