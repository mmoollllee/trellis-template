<?php

add_action('wp_enqueue_scripts', function () {
   $rand = "";
   if (defined('WP_ENV') && WP_ENV == 'development') {
      $rand = rand();
   }

   // wp_enqueue_style(
   //    'theme-bootstrap-reboot',
   //    get_template_directory_uri() . '/css/bootstrap-reboot.css', false, $rand
   // );
   // wp_enqueue_style(
   //    'theme-bootstrap-grid',
   //    get_template_directory_uri() . '/css/bootstrap-grid.css', false, $rand
   // );
   wp_enqueue_style(
      'theme-bootstrap',
      get_template_directory_uri() . '/css/bootstrap.css', false, $rand
   );

   wp_enqueue_style('main-style', get_stylesheet_uri(), false, $rand);

   wp_enqueue_style(
      'theme-main',
      get_template_directory_uri() . '/css/main.css', false, $rand
   );

   wp_enqueue_style(
      'swiper',
      get_template_directory_uri() . '/css/vendor/swiper-bundle.min.css', false, $rand
   );

});