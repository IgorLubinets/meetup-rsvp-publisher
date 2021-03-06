( function($) {
$(document).ready( function() {


	//Shortcode object 
	var shortCode = new Object; 
	shortCode['allStatus'] = $('input[name="allStatus"]:checked').val();
	console.log('INITIAL: CHeCKBOX SET TO: ' + shortCode['allStatus'] );
	
	shortCode['display'] = $('input[name="pickLayout"]:checked').val();
	console.log('PICK LAYOUT = ', shortCode['display'] );

	var ShortCodeModel = Backbone.Model.extend({
		initialize: function(){
			this.set('excludeGroups', {})		
			if( 'show' === $('input[name="allStatus"]:checked').val() )	{
				flipEye( true );				
			}
			else {
				flipEye( false );
			}
			
		}	
	});
	var readyShortCode = new ShortCodeModel({ 
		allStatus: $('input[name="allStatus"]:checked').val(),
	});
	console.log('Backbone: initial checkbox set to: ' + readyShortCode.get('allStatus') );

	readyShortCode.on("change", function() {
		console.log('Model Change Detected');
		console.log('NEW SHORTCODE==> ' + updateShortCodeString() ); 
		$('#shortCode').val( updateShortCodeString() );		
		console.log('End Model Change Detected');
		flashShortCode( $('#shortCode'), 'animation' ); 	
	});

	var item_length = $('.meetup-slides>div').length;
	console.log('Number of Groups: ' + item_length);

	$('.meetup-slides').slick({
  			centerPadding: '60px',
	  		slidesToShow: 4,
			initialSlide: 1,
  			arrows: false,
			infinite: false,
			centerMode: true,
			swipeToSlide: true,
			responsive: [
			{
	    		breakpoint: 1600,
      		settings: {
					slidesToShow: 3,
        			arrows: false,
        			centerPadding: '40px',
		    	}
    		}, {
	    		breakpoint: 1368,
      		settings: {
					slidesToShow: 2.5,
        			arrows: false,
        			centerPadding: '40px',
		    	}
    		}, { 
				breakpoint: 600,
      		settings: {
        			arrows: false,
        			centerMode: false,
        			centerPadding: '40px',
        			slidesToShow: 1.25,
					initialSlide: 0 
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
	});
	
		//Hack the slider
		//Slick slider will not show if the element is hidden.  In this case
		//	the modal is hidden, so slick cannot calculate the proper dimensions.
		//		When you start dragging then it appears.  Otherwise width set to zero.
		//		This seems to work, need more testing!
		$('#show-preview').click( function() {

		//	$(window).trigger('resize'); // was a good idea to try with the infinite on

		//	$('.meetup-admin-preview-slides').slick('unslick').slick('reinit');			
		//		console.log( 'Shortcode: ' + $('#shortCode').val() );
		
		//testing admin-ajax.php 
			var shortCodeValue = $('#shortCode').val();	
			var data = {
				action: 'webilect_rsvp_publish_ajax',
				shortcode: shortCodeValue,
			};	
			//console.log( 'Will Be Passing: ' + $('#shortCode').val() );
		 
			console.log('ADMIN_AJAX============' , admin_url.ajax_url);		

	
			$.post( admin_url.ajax_url, data, function( response ) {
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


		//REDUNDANT!! Decided not to go there...
		//Sets the default shortcode to the one currently displayed in the box		
		$('#set-as-default').click( function() {
			var shortCodeValue = $('#shortCode').val();
			if( shortCodeValue === '' ) {
				alert( 'Shortcode is empty, try again' );
			}
			var data = {
				action: 'webilect_rsvp_publish_set_default_shortcode_ajax',
				shortcode: shortCodeValue,
			};
			$.post( admin_url.ajax_url, data, function( response ) {
				console.log( response );
			});			
		});
		/////////////////////////////////////
		//END REDUNDANT

		//Drag and Drop reorder RSVP details
		/////////////////////////////////////
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();		

		$('#sortable').sortable({
			stop: function( event, ui ) {
				console.log( $('#sortable').sortable("toArray") );
				var rsvpFieldOrder = $('#sortable').sortable("toArray");
				var data = {
					action: 'webilect_rsvp_publish_rsvp_fields_reorder_ajax',
					rsvpFieldOrder: rsvpFieldOrder,
				};	
				$.post( admin_url.ajax_url, data, function( response ) {
					console.log( response );	
				});
			}
		});


		//handle visibility toggle buttons
		///////////////////////////////////////////
		// if user clicks on the eye, to make it invisible
		$('span[id^="make-visible-"]').click( function() {
			console.log('Clicked the eye');	
			$(this).css( 'display', 'none' );
			$(this).parent('div').find('span[id^="make-invisible-"]').css('display', 'block');		
			var currentMeetupItem = $(this).closest('.meetup-item');
			$(this).closest('.meetup-item').addClass('grayout');
			
			console.log('Current Meetup Item ID: ' + currentMeetupItem.attr('id') );
			var currentGroups = _.clone( readyShortCode.get('excludeGroups') );
			currentGroups[ currentMeetupItem.attr('id') ] = false;

			console.log( 'Contents of currentGroups array before model ' + JSON.stringify(currentGroups) );
			readyShortCode.set( 'excludeGroups', currentGroups );
		
			console.log( 'Added item: ' + JSON.stringify(readyShortCode.get('excludeGroups'))  );		
			
			updateShortCodeString();
		});
		// if user clicks on the crossed out eye to make it visible
		$('span[id^="make-invisible-"]').click( function() {
			$(this).css( 'display', 'none' );
			$(this).parent('div').find('span[id^="make-visible-"]').css('display', 'block');		
			var currentMeetupItem = $(this).closest('.meetup-item');
			$(this).closest('.meetup-item').removeClass('grayout');
			
			console.log('Current Meetup Item ID: ' + currentMeetupItem.attr('id') );
			var currentGroups = _.clone( readyShortCode.get('excludeGroups') );
			currentGroups[ currentMeetupItem.attr('id') ] = true;
			console.log( 'Contents of currentGroups array before model ' + JSON.stringify(currentGroups) );
			readyShortCode.set( 'excludeGroups', currentGroups );
		
			console.log( 'Added item: ' + JSON.stringify(readyShortCode.get('excludeGroups'))  );		
			
			updateShortCodeString();
		});
		//////////////////////////////////
		// end handle visibility toggle buttons


		////////////////////////////////////////////
		//Handle the Cards (masonry)
		$('.meetup-rsvp-publisher-cards').masonry({
			itemSelector: '.meetup-rsvp-publisher-card-item',
			columnWidth: 200,

		});
		//End handling the Cards
		////////////////////////////////////////////




		//Code to handle ShowAll HideAll radio buttons 
		/////////////////////////////////////////////////////////////////////
		$('#allStatusShow').click( function() {
			if( shortCode['allStatus'] !== 'show' ) {
				//toggleEye();
				flipEye( true );
				readyShortCode.set('excludeGroups', {});				
				shortCode['allStatus'] = 'show';
				readyShortCode.set('allStatus', 'show');	
				updateShortCodeString();
			}
			
		});	
		$('#allStatusHide').click( function() {
			if( shortCode['allStatus'] !== 'hide' ) {
				//toggleEye();
				flipEye( false );
				readyShortCode.set('excludeGroups', {});				
				shortCode['allStatus'] = 'hide';	
				readyShortCode.set('allStatus', 'hide');	
				updateShortCodeString();
			}
		});	
		$('#allStatusReset').click( function() {
			$('#allStatusHide').attr('checked', false);
			$('#allStatusShow').attr('checked', true);
			shortCode['allStatus'] = 'show';
			readyShortCode.set('allStatus', 'show');	
			readyShortCode.set('excludeGroups', {});				
			readyShortCode.set('display', '');
			flipEye( true );
			$('#shortCode').val('[meetup-rsvp-publisher show="all"/]');	
			//"rewind" to first slide
			$('.meetup-slides').slick('slickGoTo', parseInt(1), true );

		});

	
		//SHORTCODE SECTION, SHORTCODE BUILDER
		//DISPLAY style radio buttons 	
		//Slider radio button in the Shortcode section
		$('#pickSlider').click( function() {
			shortCode['display'] = 'slider';
			readyShortCode.set('display', 'slider');
		});
		//Cards radio button in the Shortcode section
		$('#pickCards').click( function() {
			shortCode['display'] = 'cards';
			readyShortCode.set('display', 'cards');
		});
		//List radio button in the Shortcode section
		$('#pickList').click( function() {
			shortCode['display'] = 'list';
			readyShortCode.set('display', 'list');
		});
		//Default radio button selected
		$('#useDefault').click( function() {
			shortCode['display'] = '';
			readyShortCode.set('display', '');
		});	


		/**
		 * Function to turn all slides either ON or OFF
		 * @param flag boolean
		 * @return none
		 */	
		function flipEye( flag ) {
				var slides = $('.meetup-item');
				if( flag === true ) {
					slides.each( function() {
						$('span[id^="make-invisible-"]', this).css('display', 'none');
						$('span[id^="make-visible-"]', this).css('display', 'block');
						$(this).removeClass('grayout');
					});
						
				} else {
					slides.each( function() {
						$('span[id^="make-invisible-"]', this).css('display', 'block');
						$('span[id^="make-visible-"]', this).css('display', 'none');
						$(this).addClass('grayout');
					});
				}
		}

		//Old function, may not be necessary any more?
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
			$(window).trigger('resize');
		}

		function updateShortCodeString() {
			var showHide = ( shortCode['allStatus'] === 'show' ) ? 'show="all"' : 'hide="all"'; 
			var groupsListDirective = ( shortCode['allStatus'] === 'show' ) ? 'hideGroups' : 'showGroups';
			var groupsList = '';
			var layoutString = '';	
			var displayLayout = ( shortCode['display'] !== 'default' ) ? shortCode['display'] : false;		
			if( displayLayout ) {
				layoutString = 'display="' + displayLayout + '"';
			}
	
			$.each( readyShortCode.get('excludeGroups'), function( key, value ) {
				if( value === true  && shortCode['allStatus'] === 'hide' )	{
					console.log( key + 'Value : ' + value );	
					groupsList = groupsList + ' ' + key;
					console.log( 'Grouplist: ' + groupsList );
				}
				else if( value === false && shortCode['allStatus'] === 'show' ) {
					groupsList = groupsList + ' ' + key;
					console.log( "grouplist: " + groupsList );
				}
			});	
						
			
			var result = '[meetup-rsvp-publisher ' + showHide +
				( (groupsList !== '')? (' ' + groupsListDirective + '="' + groupsList + 
				'" ') : '' ) + ' ' + layoutString  + '/]';
			console.log( 'RESULT: ' + result );
			return result;		
			
		}
		/////////////////////////////////////////////////////////////////////
		//End Code to handle creation of the Shortcode string

		
		function calculateTransient() { 
			//Transient boxes
			var seconds = $('#seconds').spinner({ 
				min:1, //if you set to zero, transient never expires!
				change: updateTransient() 
			});
			var minutes = $('#minutes').spinner({ min:0 });
			var hours = $('#hours').spinner({ min:0 });
			var days = $('#days').spinner({ min: 0 });				
			var totalTransients = $('#transient-period').val();
			console.log( "Transient Period: " + totalTransients );
	
		}
		calculateTransient();

		//Redundant?  Meant to do something else?	
		function updateTransient( event, ui, multiplier ) {
			console.log( 'Multiplier ' + multiplier );
		}



		//SETTINGS PAGE: handle RSVP fields visibility
		///////////////////////////////////////////////////
		// if user clicks on the eye, to make it invisible
		$('.dashicons-hidden').click( function() {
			console.log('Clicked cross eye');	

			$(this).css( 'display', 'none' );
			$(this).parent('li').find('.dashicons-visibility').css('display', 'block');		

			var currentRsvpField = $(this).parent('li').attr('id');
			console.log( 'current id=' + currentRsvpField );

			$(this).parent('li').removeClass('grayout');
	
			var showHide = {
				action: 'webilect_rsvp_publish_rsvp_fields_show_hide_fields_ajax',
				todo: 'show',
				id: currentRsvpField,
			};		
			
			// send the show/hide command to the server				
			$.post( admin_url.ajax_url, showHide, function( response ) {
				console.log( response );
			});
		});
		// if user clicks on the crossed out eye to make it visible
		$('.dashicons-visibility').click( function() {
			console.log( 'Clicked the straight eye');

			$(this).css( 'display', 'none' );
			$(this).parent('li').find('.dashicons-hidden').css('display', 'block');		

			var currentRsvpField = $(this).parent('li').attr('id');
			console.log( 'clicked invisible current id=' + currentRsvpField );

	
			$(this).parent('li').addClass('grayout');			
			
			var showHide = {
				action: 'webilect_rsvp_publish_rsvp_fields_show_hide_fields_ajax',
				todo: 'hide',
				id: currentRsvpField,
			};	
			// send the show/hide command to the server				
			$.post( admin_url.ajax_url, showHide, function( response ) {
				console.log( response );
			});
		});
		//////////////////////////////////////////////////////
		// SETTINGS PAGE: end handle visibility toggle buttons

		//AUX UX function
		function flashShortCode ( element, nameOfClass ) {
			element.addClass( nameOfClass );
			setTimeout( function() { element.removeClass( nameOfClass ); }, 1000 );	
		}
		
	
});
})(jQuery);
