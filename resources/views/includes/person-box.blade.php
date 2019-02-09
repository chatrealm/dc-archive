@isset($wrapperClass)
	<div class="{{ $wrapperClass }}">
@endisset
<article class="media">
	@if ($person->image)
	<div class="media-left">
		<figure class="image is-96x96">
			<img src="{{ $person->image->thumbnail(96, 96) }}" alt="{{ $person->name }}">
		</figure>
	</div>
	@endif
	<div class="media-content">
		<h3 class="title is-3">{{ $person->name }}</h3>
		@if ($person->links->count() > 0)
			@php
				$link = $person->links->get(0);
				$url = $link->url;
			@endphp
			<p class="subtitle is-6">
				<a href="{{ $url }}" target="_blank" rel="noopener" title="{{ $link->label }}">
					@icon(['icon' => $link->icon, 'class' => 'is-small'])
					{{ $url }}
				</a>
			</p>
		@endif
		<div class="content">{{ $person->about }}</div>
		@foreach ($person->links->slice(1) as $link)
			<a href="{{ $link->url }}" target="_blank" rel="noopener" title="{{ $link->label }}">
				@icon(['icon' => $link->icon])
			</a>
		@endforeach
	</div>
</article>
@isset($wrapperClass)
	</div>
@endisset
