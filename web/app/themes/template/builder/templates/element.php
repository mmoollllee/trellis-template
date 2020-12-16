<?php
   $ids = get_sub_field('element');

   if($ids) {
?>

<div class="<?php the_classes(['col-12']); ?>">
   <?php
      foreach($ids as $id) {
         builder(['post_id' => $id]);
      }
   ?>
</div>

<?php } ?>
