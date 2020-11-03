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
      'message' => 'Redaktioneller Inhalt',
      'wrapper' => ['class' => 'title'],
      'default_value' => 'Titel',
   ]);

/*
		Standard-Content-Feld
	*/

$content = new StoutLogic\AcfBuilder\FieldsBuilder('content');
$content
   ->addFields($options)
   ->addField('code', 'acf_code_field', [
      'label' => 'HTML',
      'placeholder' => '',
      'default_value' => '<section class="container">
						<div class="row">
								<div class="col-12">
										<!--content-->
								</div>
						</div>
				</section>',
   ])
   ->addWysiwyg('content', [
      'label' => 'Inhalt',
      'tabs' => 'all',
      'toolbar' => 'full',
      'media_upload' => 1,
   ]);

/*
		Galerie-Feld
	*/

$galerie = new StoutLogic\AcfBuilder\FieldsBuilder('galerie');
$galerie
   ->addFields($options)
   ->addField('code', 'acf_code_field', [
      'label' => 'HTML',
      'placeholder' => '',
      'default_value' => '<div class="col-lg-7" data-flickity=\'{
						"pageDots": true,
						"lazyLoad": 2,
						"wrapAround": true,
						"prevNextButtons": true,
						"adaptiveHeight":true,
						"contain": false,
						"autoPlay": true,
						"prevNextButtons": false
				}\'>
						<!--content-->
				</div>',
   ])
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
      'wrapper' => ['width' => '15'],
      'choices' => [
         'thumbnail' => 'thumbnail (400x400)',
         'medium' => 'medium (600x0)',
         'medium_large' => 'medium_large (900x0)',
         'large' => 'large (1800x0)',
      ],
   ])
   ->addGallery('bilder', [
      'label' => 'Bilder',
   ]);

/*
		Element
	*/

$element = new StoutLogic\AcfBuilder\FieldsBuilder('element');
$element
   ->addFields($options)
   ->addField('code', 'acf_code_field', [
      'label' => 'HTML',
      'placeholder' => '',
      'default_value' => '<!--content-->',
   ])
   ->addWysiwyg('content', [
      'label' => 'Inhalt',
      'tabs' => 'all',
      'toolbar' => 'full',
      'media_upload' => 1,
   ])
   ->addSelect('elements', [
      'label' => 'Elementauswahl',
      'multiple' => 1,
      'ui' => 1,
   ]);

/*
		Ansprechpartner
	*/

$ansprechpartner = new StoutLogic\AcfBuilder\FieldsBuilder('ansprechpartner');
$ansprechpartner
   ->addFields($options)
   ->addField('code', 'acf_code_field', [
      'label' => 'HTML',
      'placeholder' => '',
      'default_value' => '<!--content-->',
   ])
   ->addRelationship('ansprechpartner', [
      'label' => 'Ansprechpartner',
      'post_type' => [0 => 'ansprechpartner'],
      'taxonomy' => '',
      'filters' => [0 => 'search'],
      'return_format' => 'id',
   ]);

/*
		Builder
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
      'label' => 'Inhaltsfeld',
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
