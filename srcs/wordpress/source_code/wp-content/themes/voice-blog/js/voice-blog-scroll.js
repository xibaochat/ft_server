/* Auto scroll in single page on detail escaping header image */
jQuery(document).ready(function () {
    // Handler for .ready() called.
    jQuery('html, body').animate({
        scrollTop: jQuery('#scroll-here').offset().top,
    }, 2000);
  });