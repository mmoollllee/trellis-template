<?php
$aktiv = get_sub_field('aktiv');
$images = get_sub_field('bilder');
$link = get_sub_field('verlinken');
$size = get_sub_field('imagesize');
$classes = get_sub_field('classes');
$lazy = get_sub_field('lazyload');
if ($aktiv && $images) {
   $code = str_replace(
      '<!--title-->',
      get_sub_field('title'),
      get_sub_field('code')
   );
   $code = explode('<!--content-->', $code);
   $return .= $loopin . $code[0];
   foreach ($images as $image):
      $caption = $image['caption'];
      $return .=
         '<figure' .
         ($classes ? " class='" . $classes . "'" : '') .
         '>' .
         ($link
            ? "<a href='" .
               $image['sizes']['large'] .
               "' title='" .
               $image['title'] .
               "' data-fancybox='gallery" .
               get_row_index() .
               "'>"
            : '') .
         '<img ' .
         ($lazy ? 'data-flickity-lazyload' : 'src') .
         "='" .
         $image['sizes'][$size] .
         "' alt='" .
         $image['title'] .
         "' >" .
         ($link ? '</a>' : '') .
         ($caption ? '<figcaption>' . $caption . '</figcaption>' : '') .
         '</figure>';
   endforeach;
   $close[$hierarchie] = $code[1] . $loopout;
}
?>
