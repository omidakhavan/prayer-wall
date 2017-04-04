(function( $ ) {
	'use strict';

$(document).ready(function($) {
		
	// Start PrayBox
		// create button before main prayer content
		$('.pbx-formfield label').on('click', function() {
			$(this).parent().find("input[name^='pbx']").focus();
		});

		$('.pbx-formfield label').on('click', function() {
			$(this).parent().find("textarea[name^='pbx']").focus();
		});

		// prayer butoon when clicked
		$('.wn-prayer-request').click(function(event) {
			// fallout attr
			event.preventDefault();
			// get this to cash
			var $this = $(this);
			// change button text when toggled and hide form
			$( '.pbx-form' ).slideToggle( 'slow',function() {
				if ( $( '.pbx-form' ).is( ':visible' ) ) {
					$this.val( wnpw.close_praybox_button );
				} else {
					$this.val( wnpw.open_praybox_button );
				}
			});
		});

		// input when clicked placeholders got hidden
		$("input[name^='pbx'],textarea[name^='pbx']").on('focus', function() {
		    var $this = $(this);
		    $this.parent().find('label').css('margin-top', '-20px');
		    $this.closest('.pbx-formfield').addClass('pbx-active');
		}).on('blur',function(){
		    var $this = $(this);
		    $this.parent().find('label').css('margin-top', '0px');
		    $this.closest('.pbx-formfield').removeClass('pbx-active');
		});

		// submit prayer wall form 
		$(".wnpw-submit-form").on('click', function( e ) {
			e.preventDefault();

			var name = $('.wnpw-name').val();
			var last = $('.wnpw-last').val();
			var mail = $('.wnpw-mail').val();
			var title = $('.wnpw-title').val();
			var request = $('.wnpw-request').val();

				// Add loading Class to the button	
				$.ajax( {
					type: "POST",
					url: wnpw.adminurl,
					data: {
						action : 'wnpwall',
						security : wnpw.security,
						name : name,
						last : last,
						mail : mail,
						title : title,
						request : request
					},
					success: function(data) {
			            // Remove the loading Class to the button
			            setTimeout(function() {
			            	$('.wnpw-succ').css('display', 'block');
			            }, 1000);
			        },
				        error: function(jqXHR, textStatus, errorThrown) {
				        // Remove the loading Class to the button
				        setTimeout(function() {
				        	$('.wnpw-succ').css('display', 'block');
				        	$('.wnpw-succ').text('Please resubmit your pray.');
				        }, 1000);
				    }
				});
			});

		// prayer button
		$(".wm-pray-request-button").on('click', function(event) {

			event.preventDefault();

			var $this = $(this);
			$this.addClass('loading').text("Praying");

			var number = $this.data('num');
			var postid = $this.data('post');
			var num = number + 1 ;

			$.ajax( {
				type: "POST",
				url: wnpw.adminurl,
				data : { 
					action : 'wnpwprayed', 
					security : wnpw.security,
					post_id : postid,
					number : num
				},

				success: function(data) {

					setTimeout(function() {
						$this.removeClass('loading').text("I PRAYED FOR THIS");
						$this.closest('.wm-prayer-inner').find('.wn-prayer-cont').text(number+1);
						$this.data('num', number+1);

					}, 1000);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					setTimeout(function(){
						$this.removeClass('loading').text("Pray For This");
					}, 1000);
				}
			});
		});
	// End PrayBox
});
})( jQuery );
