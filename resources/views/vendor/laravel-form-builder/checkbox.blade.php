@component('laravel-form-builder::base', $__data)
	@if ($showField)
		@if ($showLabel && $options['label'] !== false && $options['label_show'])
			<label for="{{ $name }}" {!! Html::attributes($options['label_attr']) !!}>
		@endif
		@if ($showField)
			<?= Form::checkbox($name, $options['value'], $options['checked'], $options['attr']) ?>
		@endif
		@if ($showLabel && $options['label'] !== false && $options['label_show'])
			<?= $options['label'] ?></label>
		@endif

		@slot('help')
			@include('laravel-form-builder::help_block')
		@endslot
	@endif
	@slot('errorslot')
		@include('laravel-form-builder::errors')
	@endslot
@endcomponent
