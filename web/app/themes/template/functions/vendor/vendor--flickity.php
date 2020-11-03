<?php

function flickity_enqueue_script() {
   wp_enqueue_script(
      'flickity-script',
      get_template_directory_uri() . '/vendor/flickity/flickity.2.2.0.js',
      ['jquery'],
      false,
      true
   );
}
add_action('wp_enqueue_scripts', 'flickity_enqueue_script', 11);

function flickity_enqueue_style() {
   wp_enqueue_style(
      'flickity-css',
      get_template_directory_uri() . '/vendor/flickity/flickity.2.2.0.css'
   );
}
add_action('wp_enqueue_scripts', 'flickity_enqueue_style', 9);
