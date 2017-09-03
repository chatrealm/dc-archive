@extends('layouts.app')

@section('content')
	<section class="section">
		<div class="container">
			<?php
			$defaultBag = $errors->getBag('default');
			$errors->put('default', $defaultBag);

			$errors->add('email', 'Test Error');

			$form = \FormBuilder::plain();
			$form->add('text', 'text', [
				'help_block' => [
					'text' => 'Help Text'
				]
			]);
			$form->add('email', 'email');
			$form->add('password', 'password');
			$form->add('hidden', 'hidden');
			$form->add('textarea', 'textarea');
			$form->add('number', 'number');
			$form->add('file', 'file');
			$form->add('image', 'image');
			$form->add('url', 'url');
			$form->add('tel', 'tel');
			$form->add('search', 'search');
			$form->add('color', 'color');
			$form->add('date', 'date');
			$form->add('datetime-local', 'datetime-local');
			$form->add('month', 'month');
			$form->add('range', 'range');
			$form->add('time', 'time');
			$form->add('week', 'week');
			$form->add('select', 'select', [
				'attr' => ['class' => 'is-fullwidth'],
				'choices' => [
					'one',
					'two',
					'three'
				]
			]);
			$form->add('buttongroup', 'buttongroup', [
				'buttons' => [
					['label' => 'One', 'attr' => ['class' => 'button']],
					['label' => 'Two', 'attr' => ['class' => 'button']],
				]
			]);
			$form->add('button', 'button');
			$form->add('submit', 'submit');
			$form->add('reset', 'reset');
			$form->add('radio', 'radio', [
				'value' => 2,
				'checked' => false
			]);
			$form->add('checkbox', 'checkbox', [
				'value' => 2,
				'checked' => false
			]);
			$form->add('choice', 'choice', [
				'choices' => [
					'one',
					'two',
					'three'
				]
			]);
			$form->add('choice_expanded', 'choice', [
				'choices' => [
					'one',
					'two',
					'three'
				],
				'expanded' => true
			]);
			$form->add('choice_multiple', 'choice', [
				'choices' => [
					'one',
					'two',
					'three'
				],
				'multiple' => true
			]);
			$form->add('choice_expanded_multiple', 'choice', [
				'choices' => [
					'one',
					'two',
					'three'
				],
				'expanded' => true,
				'multiple' => true
			]);
			$form->add('repeated', 'repeated', [
				'type' => 'password',
				'second_name' => 'repeated_confirmation',
				'first_options' => [],
				'second_options' => [],
			]);
			$form->add('static', 'static', [
				'tag' => 'div', // Tag to be used for holding static data,
				'value' => 'Static Text' // If nothing is passed, data is pulled from model if any
			]);
			?>

			{!! form($form) !!}
		</div>
	</section>
@endsection
