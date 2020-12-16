<?php
	$h = $hierarchie + 3;
	$layout_map = [
		'full' => 'col-12',
		'50-50' => 'col-12 col-md-6',
		'1-3' => 'col-12 col-md-4',
		'2-3' => 'col-12 col-md-8'
	];
	$layout = $layout_map[get_sub_field("layout")];
	$code = sort_parts(get_sub_field('code'), $content, $title);

?>

<?php 
	if (isset($code['close']) && !empty($code['close'])) {
		echo $code['return'];
		echo '<!--childs-->';
?>
<?php
		echo $code['close'];
	} else {
?>
	<div class="<?php the_classes(['content', $layout]); ?>">
		<?php echo $slug ? '<div class="anchor" id="'.$slug.'"></div>' : ''; ?>
		<?php if (!$has_title && $title) { ?><h3><!--title--></h3><?php } ?>
		<div class="inner">
			<!--content-->
		</div>
	</div>
<?php
	}
?>
