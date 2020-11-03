<?php
$aktiv = get_sub_field('aktiv');
$content = str_replace(
   '<!--title-->',
   get_sub_field('title'),
   get_sub_field('content')
);

if ($aktiv) {
   $code = str_replace(
      '<!--title-->',
      get_sub_field('title'),
      get_sub_field('code')
   );

   $code = preg_split('/(<!--content-->|<!--childs-->)/', $code);
   preg_match_all(
      '/(<!--content-->)|(<!--childs-->)/',
      get_sub_field('code'),
      $matches,
      PREG_PATTERN_ORDER
   );

   $close[$hierarchie] = '';

   $return .= $loopin;
   $return .= $code[0];

   if (isset($matches[0][0]) && isset($matches[0][1])) {
      if (
         $matches[0][0] == '<!--content-->' &&
         $matches[0][1] == '<!--childs-->'
      ) {
         $return .= $content;
         $return .= $code[1];
         $close[$hierarchie] .= $code[2];
      } elseif (
         $matches[0][0] == '<!--childs-->' &&
         $matches[0][1] == '<!--content-->'
      ) {
         $close[$hierarchie] .= $code[1];
         $close[$hierarchie] .= $content;
         $close[$hierarchie] .= $code[2];
      }
   } else {
      $return .= $content;
      if (isset($code[1])) {
         $close[$hierarchie] .= $code[1];
      }
   }

   $close[$hierarchie] .= $loopout;
}
?>
