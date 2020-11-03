<?php

/*
  Menü's registern, css klassen hinzufügen
*/

register_nav_menus([
   'top' => 'Hauptmenü',
   'footer' => 'Footermenü',
]);

function mg_menu_classes($classes, $item, $args) {
   if ($args->theme_location == 'top') {
      $classes[] = 'list-group-item flex-fill';
   }
   return $classes;
}
//add_filter('nav_menu_css_class', 'mg_menu_classes', 1, 3);
