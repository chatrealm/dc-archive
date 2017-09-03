<?php

return [
	'defaults' => [
		'wrapper_class' => 'control',
		'wrapper_error_class' => 'has-error',
		'label_class' => 'label',
		'field_class' => 'input',
		'help_block_class' => 'help',
		'error_class' => 'help is-danger',
		'required_class' => 'required',

		// Override a class from a field.
		'textarea' => [
			'field_class' => 'textarea'
		],
		'file' => [
			'wrapper_class' => '',
			'field_class' => 'file-input'
		],
		'image' => [
			'wrapper_class' => '',
			'field_class' => 'button'
		],
		'select' => [
			'field_class' => ''
		],
		'button' => [
			'wrapper_class' => '',
			'field_class' => 'button'
		],
		'submit' => [
			'wrapper_class' => '',
			'field_class' => 'button'
		],
		'reset' => [
			'wrapper_class' => '',
			'field_class' => 'button secondary'
		]
	],
	// Templates
	'form' => 'laravel-form-builder::form',
	'text' => 'laravel-form-builder::text',
	'textarea' => 'laravel-form-builder::textarea',
	'file' => 'laravel-form-builder::file',
	'button' => 'laravel-form-builder::button',
	'buttongroup' => 'laravel-form-builder::buttongroup',
	'radio' => 'laravel-form-builder::radio',
	'checkbox' => 'laravel-form-builder::checkbox',
	'select' => 'laravel-form-builder::select',
	'choice' => 'laravel-form-builder::choice',
	'repeated' => 'laravel-form-builder::repeated',
	'child_form' => 'laravel-form-builder::child_form',
	'collection' => 'laravel-form-builder::collection',
	'static' => 'laravel-form-builder::static',

	// Remove the laravel-form-builder:: prefix above when using template_prefix
	'template_prefix' => '',

	'default_namespace' => 'Chatrealm\DCArchive\Forms',

	'custom_fields' => [
		'file' => Chatrealm\DCArchive\Forms\Fields\FileType::class
	]
];
