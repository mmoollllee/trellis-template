<?php

$tempreturn = '';
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

   $code = preg_split(
      '/(<!--content-->|<!--elemente-->|<!--childs-->)/',
      $code
   );
   preg_match_all(
      '/(<!--content-->)|(<!--elemente-->)|(<!--childs-->)/',
      get_sub_field('code'),
      $matches,
      PREG_PATTERN_ORDER
   );

   $close[$hierarchie] = '';
   $elemente = get_sub_field('elements');
   $priosplit = false;
   $returned_elemente = false;

   if (!empty($elemente)):
      $tempreturn .= $code[0];

      if (isset($matches[0][0])) {
         // Who's first?
         if ($matches[0][0] == '<!--content-->') {
            $tempreturn .= $content . '<!--potentialsplit-->';
         }
         if ($matches[0][0] == '<!--elemente-->') {
            $returned_elemente = true;
            foreach ($elemente as $id):
               $tempreturn .=
                  load_template_part($id . '/template') .
                  '<!--potentialsplit-->';
            endforeach;
         }
         if ($matches[0][0] == '<!--childs-->') {
            $tempreturn .= '<!--priosplit-->';
            $priosplit = true;
         }
         $tempreturn .= $code[1];
      }

      if (isset($matches[0][1])) {
         // Who's second?
         if ($matches[0][1] == '<!--content-->') {
            $tempreturn .= $content . '<!--potentialsplit-->';
         }
         if ($matches[0][1] == '<!--elemente-->') {
            $returned_elemente = true;
            foreach ($elemente as $id):
               $tempreturn .=
                  load_template_part($id . '/template') .
                  '<!--potentialsplit-->';
            endforeach;
         }
         if ($matches[0][1] == '<!--childs-->') {
            $tempreturn .= '<!--priosplit-->';
            $priosplit = true;
         }
         if (isset($code[2])) {
            $tempreturn .= $code[2];
         }
      }

      if (isset($matches[0][2])) {
         // Who's third?
         if ($matches[0][2] == '<!--content-->') {
            $tempreturn .= $content . '<!--potentialsplit-->';
         }
         if ($matches[0][2] == '<!--elemente-->') {
            $returned_elemente = true;
            foreach ($elemente as $id):
               $tempreturn .=
                  load_template_part($id . '/template') .
                  '<!--potentialsplit-->';
            endforeach;
         }
         if ($matches[0][2] == '<!--childs-->') {
            $tempreturn .= '<!--priosplit-->';
            $priosplit = true;
         }
         if (isset($code[3])) {
            $tempreturn .= $code[3];
         }
      }
   endif;

   if ($priosplit) {
      $finalsplit = preg_split('/(<!--priosplit-->)/', $tempreturn);
   } else {
      $finalsplit = preg_split('/(<!--potentialsplit-->)/', $tempreturn, 2);
   }

   $return .= $finalsplit[0];

   if ($returned_elemente == false) {
      foreach ($elemente as $id):
         $return .=
            load_template_part($id . '/template') . '<!--potentialsplit-->';
      endforeach;
   }

   if (isset($finalsplit[1])) {
      $close[$hierarchie] .= $finalsplit[1];
   }

   $close[$hierarchie] .= $loopout;
}
?>
