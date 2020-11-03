<?php

add_action('admin_enqueue_scripts', function () {
   wp_enqueue_script(
      'mg_arrive',
      get_template_directory_uri() . '/builder/js/arrive.min.js'
   );
   wp_enqueue_script(
      'mg_builder_script',
      get_template_directory_uri() . '/builder/js/builder.js',
      ['mg_arrive']
   );
   wp_enqueue_style(
      'mg_builder_style',
      get_template_directory_uri() . '/builder/css/builder.css',
      false
   );
   if (!current_user_can('administrator')) {
      wp_enqueue_script(
         'mg_builder_script_restrict',
         get_template_directory_uri() . '/builder/js/builder-restrict.js',
         ['mg_arrive', 'mg_builder_script']
      );
      wp_enqueue_style(
         'mg_builder_restrict',
         get_template_directory_uri() . '/builder/css/builder-restrict.css',
         false
      );
   }
});

function builder($args = false) {
   $defaults = [
      'label' => 'builder',
      'post_id' => false,
      'print' => true,
   ];
   $args = wp_parse_args($args, $defaults);

   $return = '';
   $hierarchie = 0;
   $hierarchie_prev = -1;
   $close = [];

   if (have_rows($args['label'], $args['post_id'])):
      while (have_rows($args['label'], $args['post_id'])):
         the_row();

         $hierarchie = get_sub_field('hierarchie');
         if ($hierarchie <= $hierarchie_prev) {
            $i = 0;
            while ($hierarchie <= $hierarchie_prev) {
               if (isset($close[$hierarchie_prev])) {
                  $return .= "\n" . $close[$hierarchie_prev] . "\n";
                  $close[$hierarchie_prev] = '';
               }
               $hierarchie_prev--;
               $i++;
            }
         }

         $layout = explode('--', get_row_layout());

         require 'templates/' . $layout[0] . '.php';

         $template_parts = preg_split(
            '/(<!--content-->|<!--childs-->)/',
            $template
         );
         preg_match_all(
            '/(<!--content-->)|(<!--childs-->)/',
            $template,
            $matches,
            PREG_PATTERN_ORDER
         );

         $close[$hierarchie] = '';

         $return .= $template_parts[0];

         if (isset($matches[0][0]) && isset($matches[0][1])) {
            if (
               $matches[0][0] == '<!--content-->' &&
               $matches[0][1] == '<!--childs-->'
            ) {
               $return .= $content;
               $return .= $template_parts[1];
               $close[$hierarchie] .= $template_parts[2];
            } elseif (
               $matches[0][0] == '<!--childs-->' &&
               $matches[0][1] == '<!--content-->'
            ) {
               $close[$hierarchie] .= $template_parts[1];
               $close[$hierarchie] .= $content;
               $close[$hierarchie] .= $template_parts[2];
            }
         } else {
            $return .= $content;
            if (isset($template_parts[1])) {
               $close[$hierarchie] .= $template_parts[1];
            }
         }
         $hierarchie_prev = $hierarchie;
      endwhile;

      $return .= '<!-- last loop-->';
      for ($i = count($close) - 1; $i >= 0; $i--) {
         $return .= $close[$i];
      }
   endif;

   if ($args['print']) {
      print_r($return);
   } else {
      return $return;
   }
}

?>
