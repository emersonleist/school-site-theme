<?php
// This file is generated. Do not modify it manually.
return array(
	'custom-blocks' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'school-blocks/custom-blocks',
		'version' => '0.1.0',
		'title' => 'Animate on Scroll',
		'category' => 'media',
		'icon' => 'arrow-down-alt',
		'description' => 'animates on scroll',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'align' => true
		),
		'attributes' => array(
			'aosAnimation' => array(
				'type' => 'string',
				'default' => 'fade-left'
			)
		),
		'textdomain' => 'custom-blocks',
		'editorScript' => 'file:./index.js'
	)
);
