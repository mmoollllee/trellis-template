<?php
	$h = $hierarchie + 2;
	$layout = [];
	$layout_map = [
		'full' => 'col-12',
		'50-50' => 'col-12 col-md-6',
		'1-3' => 'col-12 col-md-4',
		'2-3' => 'col-12 col-md-8'
	];
	foreach (get_sub_field("layout") as $value) {
		$layout[] = array_key_exists($value, $layout_map) ? $layout_map[$value] : $value;
	}
	$code = sort_parts(get_sub_field('code'), $content, $title);

?>

<section class="<?php the_classes([...$layout]); ?>">
	<?php echo $slug ? '<div class="anchor" id="'.$slug.'"></div>' : ''; ?>
	<?php 
		if (isset($code['close']) && !empty($code['close'])) {
			echo $code['return'];
			echo '<!--childs-->';
	?>
	<?php
			echo $code['close'];
		} else {
	?>
		<div class="row">
			<?php if (!$has_title && $title) { ?><h2 class="h3 col-12"><?php echo $title; ?></h2><?php } ?>
			<?php if (!empty($content)) { ?><div class="col-12"><?php } ?>
				<!--content-->
			<?php if (!empty($content)) { ?></div><?php } ?>
				<!--childs-->
		</div>
	<?php
		}
	?>
</section>
