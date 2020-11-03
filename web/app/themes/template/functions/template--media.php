<?php

/*
  Optionen für Standardgrößen überschreiben und Post Thumbnails aktivieren
*/

//add_image_size( 'custom-image', 2000, 1200, true );
//add_image_size( 'portrait', 300, 300, array( 'center', 'center' ) );
add_image_size('slider', 960, 300, ['top', 'center']);

#add_theme_support( 'post-thumbnails' );

#Standardgrößen
#set_post_thumbnail_size( 440, 300, true );
update_option('thumbnail_size_w', 440);
update_option('thumbnail_size_h', 300);
update_option('thumbnail_crop', 1);
update_option('medium_size_w', 600);
update_option('medium_size_h', 0);
update_option('medium_large_size_w', 900);
update_option('medium_large_size_h', 0);
update_option('large_size_w', 1800);
update_option('large_size_h', 0);

/*
  ACF Image Size Auswahl füllen
*/

function acf_load_image_sizes($field) {
   // reset choices
   $field['choices'] = [];
   global $_wp_additional_image_sizes;

   foreach (get_intermediate_image_sizes() as $_size) {
      if (in_array($_size, ['thumbnail', 'medium', 'medium_large', 'large'])) {
         $field['choices'][$_size] =
            $_size .
            ' (' .
            get_option("{$_size}_size_w") .
            'x' .
            get_option("{$_size}_size_h") .
            ')';
      } elseif (isset($_wp_additional_image_sizes[$_size])) {
         $field['choices'][$_size] =
            $_size .
            ' (' .
            $_wp_additional_image_sizes[$_size]['width'] .
            'x' .
            $_wp_additional_image_sizes[$_size]['height'] .
            ')';
      }
   }

   // return the field
   return $field;
}
add_filter('acf/load_field/name=imagesize', 'acf_load_image_sizes');
