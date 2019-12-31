jQuery(document).ready(function(){
  if(screen.width <= 575) {
    jQuery('.banner').slick({
      infinite: true,
      speed: 1000,
      slidesToScroll: 1,
      slidesToShow: 1,
      autoplay:true,
    
    });
  } else {
    jQuery('.banner').slick({
      infinite: true,
      speed: 1000,
      slidesToScroll: 2,
      slidesToShow: 2,
      autoplay:true,
    
    });
  }
});

jQuery(document).ready(function(){
  jQuery('.banner-above-blog').slick({
    infinite: true,
    speed: 1000,
    slidesToShow: 1,
    autoplay:true,
    slidesToScroll: 1,
    // fade: true,
  });
});

jQuery(document).ready(function(){
  jQuery('.post-slider').slick({
    dots: true,
    infinite: true,
    arrows: false,
    speed: 1000,
    slidesToShow: 1,
    autoplay:true,
    slidesToScroll: 1
  });
});


jQuery(document).ready(function(){
  jQuery('.instagram .row').slick({
    dots: true,
    infinite: true,
    arrows: true,
    speed: 500,
    slidesToShow: 6,
    autoplay:true,
    slidesToScroll: 1,
    fade: false,
    swipeToSlide: true,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
    ]
  });
});

jQuery(document).ready(function(){
  jQuery('.related-posts .row').slick({
    dots: true,
    infinite: true,
    arrows:false,
    speed: 500,
    slidesToShow: 3,
    autoplay:true,
    slidesToScroll: 3,
    fade: false,
    swipeToSlide: true,
    responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1
      }
    }
    ]
  });
});

jQuery(function () {
  jQuery('a[href="#search"]').on('click', function(event) {
    event.preventDefault();
    jQuery('#search').addClass('open');
    jQuery('#search > form > input[type="search"]').focus();
  });

  jQuery('#search, #search button.close').on('click keyup', function(event) {
    if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
      jQuery(this).removeClass('open');
    }
  });
});

jQuery('[data-sidenav]').sidenav();

(function($) {
  "use strict";
   $(document).on('ready', function() {	

  /*====================================
        Scrool Up
      ======================================*/ 	
      $.scrollUp({
        scrollName: 'scrollUp',      // Element ID
        scrollDistance: 800,         // Distance from top/bottom before showing element (px)
        scrollFrom: 'top',           // 'top' or 'bottom'
        scrollSpeed: 1000,            // Speed back to top (ms)
        animationSpeed: 200,         // Animation speed (ms)
        scrollTrigger: false,        // Set a custom triggering element. Can be an HTML string or jQuery object
        scrollTarget: false,         // Set a custom target element for scrolling to. Can be element or number
        scrollText: ["<i class='fa fa-arrow-circle-up'></i>"], // Text for element, can contain HTML
        scrollTitle: false,          // Set a custom <a> title if required.
        scrollImg: false,            // Set true to use image
        activeOverlay: false,        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 2147483647           // Z-Index for the overlay
      });   

  });	

})(jQuery);
