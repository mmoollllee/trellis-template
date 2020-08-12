<?php

	function mg_enqueue_builder() {
			wp_enqueue_script( 'mg_arrive', get_template_directory_uri() . '/builder/arrive.min.js' );
			wp_enqueue_script( 'mg_builder_script', get_template_directory_uri() . '/builder/builder.js' );
			wp_register_style( 'mg_builder_style', get_template_directory_uri() . '/builder/builder.css', false );
			wp_enqueue_style( 'mg_builder_style' );
//        if (current_user_can('administrator')) { }
        if (!(current_user_can('administrator'))) {
	        wp_register_style( 'mg_builder_restrict', get_template_directory_uri() . '/builder/builder-restrict.css', false );
					wp_enqueue_script( 'mg_builder_script_restrict', get_template_directory_uri() . '/builder/builder-restrict.js' );
        	wp_enqueue_style( 'mg_builder_restrict' );
        }
	}
add_action( 'admin_enqueue_scripts', 'mg_enqueue_builder' );


function builder($args = false) {
	$defaults = array (
		"label" => "builder",
		"post_id" => false,
		"print" => true
	);
	$args = wp_parse_args( $args, $defaults );

	$post_id = apply_filters('acf/get_post_id', $args['post_id'] );
	$return = "";
	$hierarchie = 0;
	$last_hierarchie = -1;
	$close = array();
	$loopin = false; $loopout = false;

	if( have_rows($args['label'], $args['post_id']) ):
		while ( have_rows($args['label'], $args['post_id']) ) : the_row();

			$hierarchie_aktuell = get_sub_field("hierarchie");
			if($hierarchie_aktuell <= $last_hierarchie) {
				$i = 0;
				while ( $hierarchie_aktuell <= $last_hierarchie) {

					if ( $i == 1 ) {
						$loopin = false; $loopout = false;
					}
					if(isset($close[$last_hierarchie])) {
						$return .= "\n".$close[$last_hierarchie]."\n";
						$close[$last_hierarchie] = "";
					}
					$last_hierarchie--;
					$i++;
				}
			}
			$hierarchie = get_sub_field("hierarchie");

			$layout = explode("--", get_row_layout());

			require('templates/'.$layout[0].'.php' );

			$last_hierarchie = $hierarchie;
		endwhile;

		$return .= "<!-- last loop-->";
		for($i = count($close) - 1; $i >= 0; $i--) {
			$return .= $close[$i];
		}
	endif;

	if ($args['print']) { print_r($return); } else { return $return; }

}

function load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name); // Alternative: include(locate_template('your-template-name.php'));
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

?>
