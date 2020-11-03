<?php

/* SVG erlauben */

function mg_svg($svg_mime) {
   $svg_mime['svg'] = 'image/svg+xml';
   return $svg_mime;
}
add_filter('upload_mimes', 'mg_svg');
