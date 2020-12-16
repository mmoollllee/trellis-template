<?php

/**
 * Startseite
 */
$builder = new StoutLogic\AcfBuilder\FieldsBuilder('startseite', [
   'title' => 'Startseite',
   'style' => 'default',
   'position' => 'acf_after_title'
]);
$builder
   ->addNumber('anzahl_an_neuigkeiten', [
      'label' => 'Anzahl Neuigkeiten'
   ])
   ->addRepeater('splash-slides', [
      'label' => 'Titel-Slider',
      'layout' => 'block'
   ])
      ->addImage('bg', [
         'label' => 'Hintergrund',
         'return_format' => 'array'
      ])
      ->addWysiwyg('inhalt', [
         'label' => 'Inhalt',
         'tabs' => 'all',
         'toolbar' => 'full',
         'media_upload' => 0,
      ])
      ->addField('code', 'acf_code_field', [
         'label' => 'HTML',
         'placeholder' => '',
         'default_value' => '',
      ])

   ->setLocation('page', '==', '2');

add_action('acf/init', function () use ($builder) {
   acf_add_local_field_group($builder->build());
});
