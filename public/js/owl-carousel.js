/* ---------------------------------------------
owl-carousel
 --------------------------------------------- */

$(document).ready(function() {
"use strict";
var owl = $('.owl-carousel');
owl.owlCarousel({
loop: false,
mouseDrag: false,
useMouseWheel: false,
nav: true,
margin:14,
responsive: {
  0: {
    items: 1
  },
  
480: {
    items: 2
  },

414: {
    items: 2
  },
360: {
    items: 2
  },

320: {
    items: 2
  },

768: {
    items: 3
  },

600: {
    items: 3
  },
  960: {
    items: 3
  },
  1200: {
    items: 4
  }
,
  1024: {
    items: 4
  }

}
});
owl.on('mousewheel', '.owl-stage', function(e) {


if (e.deltaY > 0) {
  owl.trigger('');
} else {
  owl.trigger('');
}
e.preventDefault();
});
})
