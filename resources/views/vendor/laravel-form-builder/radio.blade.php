@if ($showLabel && $showField)
	@if ($options['wrapper'] !== false)
		<div {!! $options['wrapperAttrs'] !!}>
	@endif
@endif

@if ($showLabel && $options['label'] !== false && $options['label_show'])
	<label for="{{ $name }}" {!! $options['labelAttrs'] or Html::attributes($options['label_attr']) !!}>
@endif
@if ($showField)
	<?= Form::radio($name, $options['value'], $options['checked'], $options['attr']) ?>
@endif
@if ($showLabel && $options['label'] !== false && $options['label_show'])
	<?= $options['label'] ?></label>
@endif
@if ($showField)
	@include('laravel-form-builder::help_block')
@endif

@include('laravel-form-builder::errors')

@if ($showLabel && $showField)
	@if ($options['wrapper'] !== false)
		</div>
	@endif
@endif
