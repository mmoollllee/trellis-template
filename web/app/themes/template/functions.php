<?php

require_once 'builder/setup.php';

function autoload($path) {
   $items = glob($path . DIRECTORY_SEPARATOR . '*');

   foreach ($items as $item) {
      if (is_file($item) && pathinfo($item)['extension'] === 'php') {
         require_once $item;
      } elseif (is_dir($item)) {
         autoload($item);
      }
   }
}
autoload(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions');
autoload(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'acf');

// Setup Post-Types
require_once 'aktuelles/setup.php';
require_once 'ansprechpartner/setup.php';

require_once 'css/enqueue.php';
require_once 'js/enqueue.php';
