
/* ---------------------------------------------
Preloader - Home page
 --------------------------------------------- */

jQuery(window).on('load', function() {
    "use strict";
    // will first fade out the loading animation
    jQuery("#status").fadeOut();
    // will fade out the whole DIV that covers the website.
    jQuery("#preloader").fadeOut("fast");
    // jQuery("#preloader").delay(200).fadeOut("slow");

})

/* ---------------------------------------------
Top-search - All pages Header
 --------------------------------------------- */
// new UISearch(document.getElementById('sb-search'));
"use strict";
$(".nav_trigger").on('click', function() {
    $("body").toggleClass("show_sidebar");
    $(".nav_trigger .fa").toggleClass("fa-navicon fa-times"); // toggle 2 classes in Jquery: http://goo.gl/3uQAFJ - http://goo.gl/t6BQ9Q
});
/* ---------------------------------------------*/
$(document).ready(function() {
    "use strict";
    //iosSlider - Home Page main Banner
     $('.iosSlider').iosSlider({
        snapToChildren: true,
        desktopClickDrag: true,
        infiniteSlider: true,
        snapSlideCenter: true,
        autoSlide: true
    });
    //carousel- Product and product-detail page.
    $("#carousel-example-generic2").carousel();
});
