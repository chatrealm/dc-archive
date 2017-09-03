<?php
$includeWrapper = $showLabel && $showField && $options['wrapper'] !== false;
?>

@if ($includeWrapper)
	<div class="field">
@endif
	@if (isset($label))
		{{ $label }}
	@endif

	@if ($includeWrapper)
		<div {!! $options['wrapperAttrs'] !!}>
	@endif
			{{ $slot }}
	@if ($includeWrapper)
		</div>
	@endif

	@if (isset($help))
		{{ $help }}
	@endif
	@if (isset($errorslot))
		{{ $errorslot }}
	@endif
@if ($includeWrapper)
	</div>
@endif
