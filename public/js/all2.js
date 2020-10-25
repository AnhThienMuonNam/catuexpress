/* ---------------------------------------------
Top-search - All pages Header
 --------------------------------------------- */
new UISearch(document.getElementById('sb-search'));
"use strict";
$(".nav_trigger").on('click', function() {
    $("body").toggleClass("show_sidebar");
    $(".nav_trigger .fa").toggleClass("fa-navicon fa-times"); 
});

$(document).ready(function() {
  "use strict";
//carousel- Product and product-detail page.
    $("#carousel-example-generic2").carousel();
});