<?php

add_action('after_setup_theme', function () {
   add_theme_support('align-wide');
   add_theme_support('editor-styles');
   add_editor_style('css/editor.css');
});

/**
 * Limit WYSIWYG height
 */
add_action('admin_head', function () {
   ?>
	<style>
		.acf-block-fields .acf-editor-wrap iframe {			
			height: 150px !important;
			min-height: 100px !important;
		}
	</style>
	<?php
});

// Brauch ich das noch??
// add_action( 'admin_enqueue_scripts', function() {
//   wp_enqueue_style( 'theme-gutenberg', get_template_directory_uri() . '/css/gutenberg.css' );
// } );

// //    Gutenberg Styles Laden wenn nötig
//   function gutenberg_enqueue() {
//     // if ( 'produkte' === get_post_type() ) {
//       wp_enqueue_style( 'theme-gutenberg', get_template_directory_uri() . '/css/gutenberg.css' );
//     // }
//   }
// add_action( 'wp_enqueue_scripts', 'gutenberg_enqueue' );
