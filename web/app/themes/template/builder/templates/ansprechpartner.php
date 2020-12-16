<?php
	$ids = get_sub_field('ansprechpartner');

	if ($ids) {
?>
	<div class="row ansprechpartner col">
		<?php foreach($ids as $id) { ?>
		<div class="col-6 col-sm-4 col-md-3">
			<span class="name"><?php echo get_the_title($id); ?></span>
		</div>
		<?php } ?>
		<!--childs-->
	</div>
<?php } ?>