<?php

add_action('wp_enqueue_scripts', function () {
   wp_enqueue_script('jquery');
   wp_enqueue_script(
      'hash-scroll-script',
      get_template_directory_uri() .
         '/js/jquery.hash-scroll.js',
      ['jquery'],
      false,
      true
   );
   wp_enqueue_script(
      'body-scroll-script',
      get_template_directory_uri() .
         '/js/jquery.body-scroll.js',
      ['jquery'],
      false,
      true
   );
   wp_enqueue_script(
      'menu-touch-hover',
      get_template_directory_uri() .
         '/js/jquery.menu-touch-hover.js',
      ['jquery'],
      false,
      true
   );
   wp_enqueue_script(
      'haeberle',
      get_template_directory_uri() .
         '/js/jquery.haeberle.js',
      ['jquery'],
      false,
      true
   );
   wp_enqueue_script(
      'swiper',
      get_template_directory_uri() .
         '/js/vendor/swiper-bundle.min.js',
      false,
      true
   );
   wp_enqueue_script(
      'swiper-fire',
      get_template_directory_uri() .
         '/js/swiper.js',
      ['swiper', 'jquery'],
      false,
      true
   );
   wp_enqueue_script(
      'collapsible',
      get_template_directory_uri() .
         '/js/jquery.collapsible.js',
      ['jquery'],
      false,
      true
   );
   wp_enqueue_script(
      'haeberleaccordion',
      get_template_directory_uri() .
         '/js/jquery.accordion.js',
      ['jquery'],
      false,
      true
   );
   wp_enqueue_script(
      'wrappers',
      get_template_directory_uri() .
         '/js/jquery.wrappers.js',
      ['jquery'],
      false,
      true
   );
});