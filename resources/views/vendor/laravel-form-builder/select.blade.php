@component('laravel-form-builder::base', $__data)
	@if ($showField)
		@if ($showLabel && $options['label'] !== false && $options['label_show'])
			@slot('label')
				{!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
			@endslot
		@endif

		<div class="select">
			<?php $emptyVal = $options['empty_value'] ? ['' => $options['empty_value']] : null; ?>
			{!! Form::select($name, (array)$emptyVal + $options['choices'], $options['selected'], $options['attr']) !!}
		</div>

		@slot('help')
			@include('laravel-form-builder::help_block')
		@endslot
	@endif
	@slot('errorslot')
		@include('laravel-form-builder::errors')
	@endslot
@endcomponent
