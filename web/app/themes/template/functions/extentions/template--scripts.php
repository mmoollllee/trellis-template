<?php

function template_scripts_enqueue() {
   wp_enqueue_script(
      'hash-scroll-script',
      get_template_directory_uri() .
         '/functions/extentions/template--hash-scroll.js',
      ['jquery'],
      false,
      true
   );
   wp_enqueue_script(
      'body-scroll-script',
      get_template_directory_uri() .
         '/functions/extentions/template--body-scroll.js',
      ['jquery'],
      false,
      true
   );
}
add_action('wp_enqueue_scripts', 'template_scripts_enqueue');
