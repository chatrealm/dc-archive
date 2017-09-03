@component('laravel-form-builder::base', $__data)
	@if ($showField)
		@if ($showLabel && $options['label'] !== false && $options['label_show'])
			@slot('label')
				{!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
			@endslot
		@endif

		{!! Form::input($type, $name, $options['value'], $options['attr']) !!}

		@slot('help')
			@include('laravel-form-builder::help_block')
		@endslot
	@endif
	@slot('errorslot')
		@include('laravel-form-builder::errors')
	@endslot
@endcomponent
