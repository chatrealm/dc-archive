@component('laravel-form-builder::base', $__data)
	@if ($showField)
		<div class="file">
			<label class="file-label">
				{!! Form::input($type, $name, $options['value'], $options['attr']) !!}
				<div class="file-cta">
					<div class="file-label">{{ $options['label'] }}</div>
				</div>
			</label>
		</div>

		@slot('help')
			@include('laravel-form-builder::help_block')
		@endslot
	@endif
	@slot('errorslot')
		@include('laravel-form-builder::errors')
	@endslot
@endcomponent
