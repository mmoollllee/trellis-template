<?php
/**
 * This builds the whole ACF Fields for the Builder
 * File get's called from theme/functions.php
 */

/**
 * Optionen für alle Page-Builder "Layouts"
 */

$options = new StoutLogic\AcfBuilder\FieldsBuilder('options');
$options
   ->addNumber('hierarchie', [
      'label' => 'Hierarchie',
      'wrapper' => ['class' => 'hierarchie'],
      'default_value' => 0,
   ])
   ->addTrueFalse('aktiv', [
      'label' => 'Aktiv',
      'message' => 'Aktiv',
      'wrapper' => ['width' => '20'],
      'default_value' => 1,
   ])
   ->addTrueFalse('redaktionell', [
      'label' => 'Redaktionell',
      'message' => 'Redaktioneller Inhalt',
      'wrapper' => ['width' => '20'],
      'default_value' => 1,
   ])
   ->addText('title', [
      'label' => 'Titel',
      'wrapper' => ['class' => 'title'],
      'default_value' => 'Titel',
   ])
   ->addText('slug', [
      'label' => 'Titelform',
      'wrapper' => ['width' => '20'],
   ]);

/**
 * Code Overwrite Field
 */
$code = new StoutLogic\AcfBuilder\FieldsBuilder('code');
$code
   ->addField('code', 'acf_code_field', [
      'label' => 'HTML',
      'placeholder' => '',
      'default_value' => '',
   ]);

/**
 * Standard Content Feld
 */
$content = new StoutLogic\AcfBuilder\FieldsBuilder('content');
$content
   ->addFields($options)
   ->addSelect('layout', [
      'label' => 'Layout',
      'required' => 1,
      'wrapper' => ['width' => '20'],
      'choices' => [
         'full' => 'Volle Breite',
         '50-50' => 'Halbe Breite',
         '1-3' => '1/3',
         '2-3' => '2/3',
      ],
   ])
   ->addWysiwyg('inhalt', [
      'label' => 'Inhalt',
      'tabs' => 'all',
      'toolbar' => 'full',
      'media_upload' => 1,
   ])
   ->addFields($code);

/**
 * Sektion
 */
$sektion = new StoutLogic\AcfBuilder\FieldsBuilder('content');
$sektion
   ->addFields($options)
   ->addSelect('layout', [
      'label' => 'Layout',
      'required' => 0,
      'wrapper' => ['width' => '20'],
      'allow_null' => 1,
      'multiple' => 1,
      'ui' => 1,
      'choices' => [
         'bg-white' => 'Weißer Hintergrund',
         'bg-grey' => 'Grauer Hintergrund',
         'pt-0' => 'Kein Abstand nach oben',
         'pb-0' => 'Kein Abstand nach unten',
      ],
   ])
   ->addWysiwyg('inhalt', [
      'label' => 'Inhalt',
      'tabs' => 'all',
      'toolbar' => 'basic',
      'media_upload' => 1
   ])
   ->addFields($code);

/**
 * Galerie
 */
$galerie = new StoutLogic\AcfBuilder\FieldsBuilder('galerie');
$galerie
   ->addFields($options)
   ->addText('classes', [
      'label' => 'Klassen',
      'wrapper' => ['width' => '15'],
   ])
   ->addTrueFalse('verlinken', [
      'label' => 'Verlinken',
      'message' => 'Verlinken',
      'wrapper' => ['width' => '15'],
      'default_value' => 1,
   ])
   ->addTrueFalse('lazyload', [
      'label' => 'Lazyload',
      'message' => 'Lazyload',
      'wrapper' => ['width' => '15'],
      'default_value' => 1,
   ])
   ->addSelect('imagesize', [
      'label' => 'Bildgröße',
      'required' => 1,
      'wrapper' => ['width' => '20'],
      'choices' => [
         'thumbnail' => 'thumbnail (400x400)',
         'medium' => 'medium (600x0)',
         'medium_large' => 'medium_large (900x0)',
         'large' => 'large (1800x0)',
      ],
   ])
   ->addSelect('layout', [
      'label' => 'Layout',
      'required' => 1,
      'wrapper' => ['width' => '20'],
      'choices' => [
         'full-2' => 'Volle Breite, 2-spaltig',
         'halb-2' => 'Halbe Breite, 2-spaltig',
      ],
   ])
   ->addGallery('bilder', [
      'label' => 'Bilder',
   ])
   ->addFields($code);


/**
 * Elemente
 */
$element = new StoutLogic\AcfBuilder\FieldsBuilder('element');
$element
   ->addFields($options)
   ->addWysiwyg('content', [
      'label' => 'Inhalt',
      'tabs' => 'all',
      'toolbar' => 'full',
      'media_upload' => 1,
   ])
   ->addRelationship('element', [
      'label' => 'Element',
      'post_type' => [0 => 'elemente'],
      'taxonomy' => '',
      'filters' => [0 => 'search'],
      'return_format' => 'id',
   ])
   ->addFields($code);

/**
 * Ansprechpartner
 */
$ansprechpartner = new StoutLogic\AcfBuilder\FieldsBuilder('ansprechpartner');
$ansprechpartner
   ->addFields($options)
   ->removeField('title')
   ->removeField('redaktionell')
   ->addRelationship('ansprechpartner', [
      'label' => 'Ansprechpartner',
      'post_type' => [0 => 'ansprechpartner'],
      'taxonomy' => '',
      'filters' => [0 => 'search'],
      'return_format' => 'id',
   ])
   ->addFields($code);


/**
 * Builder Assembly
 */
$builder = new StoutLogic\AcfBuilder\FieldsBuilder('builder', [
   'title' => 'Builder',
   'style' => 'seamless',
   'position' => 'acf_after_title',
   'hide_on_screen' => [0 => 'the_content'],
]);
$builder
   ->addFlexibleContent('builder', [
      'label' => 'Builder',
      'button_label' => 'Eintrag hinzufügen',
      'wrapper' => ['id' => 'acf-pagebuilder'],
   ])

   ->addLayout('html', [
      'label' => 'Inhalt',
   ])
   ->addFields($content)

   ->addLayout('bilder', [
      'label' => 'Bilder',
   ])
   ->addFields($galerie)

   ->addLayout('element', [
      'label' => 'Element',
   ])
   ->addFields($element)

   ->addLayout('sektion', [
      'label' => 'Sektion',
   ])
   ->addFields($sektion)

   ->addLayout('ansprechpartner', [
      'label' => 'Ansprechpartner',
   ])
   ->addFields($ansprechpartner)

   ->setLocation('post_type', '==', 'page')
   ->or('post_type', '==', 'post')
   ->or('post_type', '==', 'elemente');

add_action('acf/init', function () use ($builder) {
   acf_add_local_field_group($builder->build());
});
