<?php

/*
  extra .js file for this
*/

function slideout_enqueue_script() {
   wp_enqueue_script(
      'slideout-script',
      get_template_directory_uri() . '/vendor/slideout/slideout.min.js',
      false,
      false,
      true
   );
   wp_enqueue_script(
      'slideout-script-starter',
      get_template_directory_uri() . '/functions/vendor/vendor--navtoggle.js',
      false,
      false,
      true
   );
}
add_action('wp_enqueue_scripts', 'slideout_enqueue_script', 11);
