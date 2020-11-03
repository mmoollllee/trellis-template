<?php

add_action(
   'init',
   function () {
      $labels = [
         'name' => __('Aktuell', 'mg'),
         'singular_name' => __('Aktuelles Eintrag', 'mg'),
      ];

      $args = [
         'label' => __('Aktuell', 'mg'),
         'labels' => $labels,
         'description' => '',
         'public' => true,
         'has_archive' => false,
         'show_ui' => true,
         'hierarchical' => false,
         'show_in_rest' => true,
         'menu_position' => 5,
         'menu_icon' => 'dashicons-calendar-alt', // https://developer.wordpress.org/resource/dashicons/
         'supports' => ['title', 'editor', 'revisions', 'thumbnail'],
         'exclude_from_search' => false,
         'capability_type' => 'post',
         'map_meta_cap' => true,
         'rewrite' => ['slug' => '/aktuell', 'with_front' => true],
         'query_var' => true,
      ];

      register_post_type('aktuell', $args);
   },
   5
);
