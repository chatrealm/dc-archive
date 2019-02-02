@isset($wrapperClass)
	<div class="{{ $wrapperClass }}">
@endisset
		@dump($person)
@isset($wrapperClass)
	</div>
@endisset
