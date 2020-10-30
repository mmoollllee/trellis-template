<?php
	$description = ( empty(get_field("meta_description")) ? get_field("meta_description",'option') : get_field("meta_description") );
	$meta = ( !empty(get_field("meta_keywords"))  ? get_field("meta_keywords") : get_field("meta_keywords",'option'));
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php echo ( get_field("noindex") === false || get_field("noindex", "option") == false  ? '<meta name="robots" content="noindex" />' :  ''); ?>
	<meta name="description" content="<?php echo $description ?>" />
	<meta name="keywords" content="<?php echo $meta ?>" />

	<!--noptimize-->
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
	<!--/noptimize-->

	<?php wp_head(); ?>

	<?php the_field('head'); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<nav class="pt-1 px-2 px-s-3 px-sm-4 px-lg-5">
  		<div class="row justify-content-between align-content-center">
			<h1 class="col-6 col-md-3 p-1 m-0 page-title">
				<a class="logo" href="<?php bloginfo( 'url' ); ?>">
					<img class="logo" src="<?php the_field("logo",'option') ?>" alt="<?php bloginfo( 'name' ); ?>" />
				</a>
        </h1>

			<?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => false, 'menu_class' => 'd-none d-xl-flex col-auto menu', 'depth' => 0) ); ?>

			<button id="navtoggle" class="icon-bars col-auto text-right d-xl-none"></button>

  		</div>
	</nav>

	<main id="content">
		<div id="main" class="anchor"></div>

		<?php if ( function_exists( 'breadcrumb_trail') && !is_home() && !is_front_page() && ( $post->post_parent > 0 || is_single() ) ) breadcrumb_trail( array( 'before' => false, 'show_browse' => false, 'labels' => array( 'error_404' => 'Fehler 404', 'paged' => 'Seite %s') ) ); ?>
