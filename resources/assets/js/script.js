$( document ).ready(function() {
    /* ----------------------------------------------------------- */
	/*  1. MAIN SLIDER
	/* ----------------------------------------------------------- */

	$('.mu-slide').slick({
		arrows: true,
		dots: false,
		infinite: true,
		speed: 500,
		autoplay: true,
		cssEase: 'linear'
	});

	
	/* ----------------------------------------------------------- */
	/*  2. VIDEO POPUP
	/* ----------------------------------------------------------- */

 //   $('.mu-video-play-btn').on('click', function(event) {
 //        event.preventDefault();
 //        $('.mu-video-iframe-area').addClass('mu-video-iframe-display');
 //    });
   
 //    // when click the close btn

 //    // disappear iframe window
 //    $('.mu-video-close-btn').on('click', function(event) {
	//     event.preventDefault();
	// 	$('.mu-video-iframe-area').removeClass('mu-video-iframe-display');
 //    });

 //    // stop iframe if it is play while close the iframe window
 //    $('.mu-video-close-btn').click(function(){
 //        $('.mu-video-iframe').attr('src', $('.mu-video-iframe').attr('src'));
 //    });

 //    // when click overlay area
 //     $('.mu-video-iframe-area').on('click', function(event) {
	//     event.preventDefault();
	// 	$('.mu-video-iframe-area').removeClass('mu-video-iframe-display');
 //    });

	// $('.mu-video-iframe-area, .mu-video-iframe').on('click', function(e){
	//     e.stopPropagation();
	// });


   	/* ----------------------------------------------------------- */
	/*  3. TESTIMONIALS (SLICK SLIDER)
	/* ----------------------------------------------------------- */

		$('.mu-testimonial-slide').not('.slick-initialized').slick({
			arrows: true,
			dots: false,
			infinite: true,
			speed: 500,
			autoplay: true,
			cssEase: 'linear'
		});

	/* ----------------------------------------------------------- */
  	/*  4. SCROLL TOP BUTTON
  	/* ----------------------------------------------------------- */

	  //Check to see if the window is top if not then display button

	   jQuery(window).scroll(function(){
	      if (jQuery(this).scrollTop() > 300) {
	        jQuery('.scrollToTop').fadeIn();
	      } else {
	        jQuery('.scrollToTop').fadeOut();
	      }
	    });
	     
	    //Click event to scroll to top

	    jQuery('.scrollToTop').click(function(){
	      jQuery('html, body').animate({scrollTop : 0},800);
	      return false;
	    });
	 
		
	/* ----------------------------------------------------------- */
	/*  5. CLIENTS SLIDEER ( SLICK SLIDER )
	/* ----------------------------------------------------------- */

		// $('.mu-clients-slider').slick({
		//   slidesToShow: 5,
		//   arrows: false,
		//   autoplay: true,
		//   responsive: [
		//     {
		//       breakpoint: 768,
		//       settings: {
		//         arrows: false,
		//         slidesToShow: 3
		//       }
		//     },
		//     {
		//       breakpoint: 480,
		//       settings: {
		//         arrows: false,
		//         slidesToShow: 2
		//       }
		//     }
		//   ]
		// });

	
	/* ----------------------------------------------------------- */
	/*  6. PORTFOLIO GALLERY
	/* ----------------------------------------------------------- */ 
	
		// $('.filtr-container').filterizr();

		// //Simple filter controls

	 //    $('.mu-simplefilter li').click(function() {
	 //       $('.mu-simplefilter li').removeClass('active');
	 //        $(this).addClass('active');
	 //    });


	/* ----------------------------------------------------------- */
	/*  7. PORTFOLIO POPUP VIEW ( IMAGE LIGHTBOX )
	/* ----------------------------------------------------------- */ 

	$('.mu-imglink').magnificPopup({
	  type: 'image',
	  mainClass: 'mfp-fade',
	  gallery:{
	    enabled:true
	  }
	});


	/* ----------------------------------------------------------- */
	/*  8. OPEN CLOSE MENU
	/* ----------------------------------------------------------- */ 
	//JQuery Open Close Menu Collapse
	$('#sidebarCollapse').on('click', function () {
	        $('#sidebar').toggleClass('active');
	        $(this).toggleClass('active');
	});

	var url = window.location.pathname;
	url = url.replace('/', '');
	$('.nav-item a').each(function(){
		if ($(this).attr('href') == url){
	        $(this).parent().addClass('active');
		}
	});

});




  
