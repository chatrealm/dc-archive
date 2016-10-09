@if ($paginator->hasPages())
	<nav class="pagination">
		@unless ($paginator->onFirstPage())
			<a href="{{ $paginator->previousPageUrl() }}" class="button" rel="prev">&laquo;</a>
		@else
			<a class="button is-disabled">&laquo;</a>
		@endif
		@if ($paginator->hasMorePages())
			<a href="{{ $paginator->nextPageUrl() }}" class="button" rel="next">&raquo;</a>
		@else
			<a class="button is-disabled">&raquo;</a>
		@endif
		<ul>
			@foreach ($elements as $element)
				@if (is_string($element))
					<li class="disabled"><span>{{ $element }}</span></li>
				@endif
				@if (is_array($element))
					@foreach ($element as $page => $url)
						@if ($page == $paginator->currentPage())
							<li><a href="{{ $url }}" class="button is-primary">{{ $page }}</a></li>
						@else
							<li><a href="{{ $url }}" class="button">{{ $page }}</a></li>
						@endif
					@endforeach
				@endif
			@endforeach
		</ul>
	</nav>

@endif
