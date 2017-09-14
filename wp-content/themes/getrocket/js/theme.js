/**
 * Get Rocket
 * http://getrocket.com.br/
 *
 * Theme javascript
 */

(function ($) {
  'use strict';
  $(document).ready(function () {

    // Slider
    if ($('.owl-carousel')) {
      $('.owl-carousel').owlCarousel({
        loop: true,
        responsiveClass: true,
        margin: 0,
        autoplay: true,
        nav: false,
        responsive: {
          0: {
            items: 1
          }
        }
      });
    }
  });



  angular.module('app', []);

})(jQuery);