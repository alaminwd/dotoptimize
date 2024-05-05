// =======counter
$('.data-count').counterUp({
    delay: 10,
    time: 1000,
});

// brad slider
  $('.brand-item').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: false,
    arrows: false,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      },
      {
        breakpoint: 375,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      },
      {
        breakpoint: 320,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      },
      
    ]
  });

// brad slider
  $('.team_slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: false,
    arrows: false,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        }
      },
      
    ]
  });



  
$('.testimonial_main').slick({
  infinite: true,
  slidesToShow: 2,
  slidesToScroll: 1,
  dots:false,
  arrows:true,
  prevArrow:'<a class="slick-prev slick-arrow " aria-label="Previous"><i class="fa-solid fa-arrow-left prev"></i></a>',
  nextArrow:'<a class="slick-prev slick-arrow " aria-label="Previous"><i class="fa-solid fa-arrow-right next"></i></a>',
  responsive: [
    {
      breakpoint: 375,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: false,
      }
    },
    {
      breakpoint: 575,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: false,
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: false,
      }
    },
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: true,
      }
    },
    
  ]
});

$('.testimonial_single').slick({
  dots: false,
  infinite: true,
  autoplay:true,
  speed: 600,
  slidesToShow: 1,
  slidesToScroll: 1,
  vertical: true,
  prevArrow:'<i class="fa-solid fa-arrow-up-long  prev"></i>',
  nextArrow:'<i class="fa-solid fa-arrow-down-long next"></i>',
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows:false,
        vertical: false,
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows:false,
        vertical: false,
      }
    }
  ]
});

(function($){
	"use strict";


	$(document).ready( function () {
		$('.testing').progressBar({
			value: "70",
			height: "35",
		});
	});
 
})(jQuery);

wow = new WOW(
  {
  boxClass:     'wow',      // default
  animateClass: 'animated', // default
  offset:       0,          // default
  mobile:       true,       // default
  live:         true        // default
}
)
wow.init();


	//----- Back to Top -----//

	$('.back_to_top').click(function () {
		$('html, body').animate({
			scrollTop: 0
		}, 1500)
	});

	$(window).scroll(function () {
		var scrolling = $(this).scrollTop();

		if (scrolling > 300) {
			$('.back_to_top').fadeIn(300);
		} else {
			$('.back_to_top').fadeOut(300)
		}

		if (scrolling > 100) {
			$('.navbar').addClass('menu_fix');
		} else {
			$('.navbar').removeClass('menu_fix');
		}
	});

// ============Card Pricing=============//


