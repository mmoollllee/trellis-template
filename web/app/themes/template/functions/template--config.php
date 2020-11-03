<?php

add_action('wp_enqueue_scripts', function () {
   wp_enqueue_style(
      'theme-bootstrap-reboot',
      get_template_directory_uri() . '/css/bootstrap-reboot.css'
   );
   wp_enqueue_style(
      'theme-bootstrap-grid',
      get_template_directory_uri() . '/css/bootstrap-grid.css'
   );
   wp_enqueue_style(
      'theme-bootstrap',
      get_template_directory_uri() . '/css/bootstrap.css'
   );

   wp_enqueue_style('main-style', get_stylesheet_uri());
   wp_enqueue_style(
      'theme-main',
      get_template_directory_uri() . '/css/main.css'
   );
   wp_enqueue_style('print', get_template_directory_uri() . '/css/print.css');

   wp_enqueue_script('jquery');

   // wp_enqueue_style( 'accordion', get_template_directory_uri() . '/vendor/accordion/css/accordion.css', false, false );
   // wp_enqueue_script('accordion-mg', get_template_directory_uri() . '/vendor/accordion/accordion.js', ['jquery']);
});
