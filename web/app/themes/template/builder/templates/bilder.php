<?php

// TODO: Implement Swiper Lazyload

	$layout_map = [
		'full-2' => 'col-12',
		'halb-2' => 'col-12 col-md-6'
	];
	$gallery_map = [
		'full-2' => 'col-6',
		'halb-2' => 'col-6'
	];
	$layout = $layout_map[get_sub_field("layout")];
	$gallery_layout = $gallery_map[get_sub_field("layout")];
	$images = get_sub_field('bilder');
   $link = get_sub_field('verlinken');
   $size = get_sub_field('imagesize');
   $classes = get_sub_field('classes');
   $lazy = get_sub_field('lazyload');

	if ($images):
?>

<div class="<?php the_classes(['content', $layout, $accordion]); ?>">
	<?php if ($title) { ?><h3><?php echo $title; ?></h3><?php } ?>
	<div class="<?php the_classes(['swiper-container', 'gallery']); ?>">
		<div class="swiper-wrapper">
			<?php
			foreach( $images as $image ):
			?>
			<figure class="<?php the_classes(['swiper-slide', $size, $classes]); ?>">
            <?php if ($link) { ?>
            <a  href="<?php echo $image['sizes']['large']; ?>" data-image-caption="<?php echo $image['caption'] ?>" title="<?php echo $image['title'] ?>" data-fancybox="gallery<?php echo get_row_index(); ?>">
            <?php } ?>
					<img src="<?php echo $image['sizes'][$size] ?>" alt="">
            <?php if ($link) { ?>
				</a>
            <?php } ?>
			</figure>
		<?php endforeach; ?>
		</div>
	</div>
	<!--childs-->
</div>

<?php endif; ?>
