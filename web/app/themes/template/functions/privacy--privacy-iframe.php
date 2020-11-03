<?php

function privacy_iframe_script() {
   wp_enqueue_script(
      'privacy-iframe-script',
      get_template_directory_uri() . '/functions/privacy--privacy-iframe.js',
      ['jquery'],
      false,
      true
   );
}
add_action('wp_enqueue_scripts', 'privacy_iframe_script', 11);
