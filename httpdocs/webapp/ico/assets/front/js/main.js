(function ($) {
	"use strict";
/*--document ready functions--*/
    jQuery(document).ready(function($){

        /*wow js init*/
		new WOW().init();
        /*bottom to top*/
        $(document).on('click','.back-to-top',function(){
           $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });
        /*--slick Nav Responsive Navbar activation--*/
          var SlicMenu = $('#main-menu');
         SlicMenu.slicknav();

        /*--------- testimonial carousel activation ---------*/
        var testimonialCarousel = $('.testimonial-carousel');
            testimonialCarousel.owlCarousel({
            loop:true,
            dots:true,
            nav:false,
            margin:20,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive : {
              0 : {
                  items: 1
              },
              768 : {
                  items: 1
              },
              960 : {
                  items: 2
              },
              1200 : {
                  items: 2
              },
              1920 : {
                  items: 2
              }
            }
        }); 
        $('.video-play-btn').magnificPopup({ type: 'video' });

        $('#main-menu li a').on('click', function (e) {
            var anchor = $(this).attr('href');
            var top = $(anchor).offset().top;
            $('html, body').animate({
                scrollTop: $(anchor).offset().top
            }, 1000);
        });

        /*--------- Clients carousel activation ---------*/
        var clientsLogoCarousel = $('.logo-carousel');
        clientsLogoCarousel.owlCarousel({
            loop: true,
            dots: false,
            nav: false,
            margin:30,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                960: {
                    items: 4
                },
                1200: {
                    items: 4
                },
                1920: {
                    items: 5
                }
            }
        });
});

           
/*--window load functions--*/
    $(window).on('load',function(){
        var preLoder = $(".preloader");
        preLoder.fadeOut(1000);
    });

}(jQuery));	