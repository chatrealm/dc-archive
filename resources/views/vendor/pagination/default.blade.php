@if ($paginator->hasPages())
	<nav class="pagination">
		@unless ($paginator->onFirstPage())
			<a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous" rel="prev">&laquo; Previous</a>
		@else
			<a class="pagination-previous" disabled>&laquo; Previous</a>
		@endif
		@if ($paginator->hasMorePages())
			<a href="{{ $paginator->nextPageUrl() }}" class="pagination-next" rel="next">Next &raquo;</a>
		@else
			<a class="pagination-next" disabled>Next &raquo;</a>
		@endif
		<ul class="pagination-list">
			@foreach ($elements as $element)
				@if (is_string($element))
					<li><span class="pagination-ellipsis">{{ $element }}</span></li>
				@endif
				@if (is_array($element))
					@foreach ($element as $page => $url)
						@if ($page == $paginator->currentPage())
							<li><a href="{{ $url }}" class="pagination-link is-current">{{ $page }}</a></li>
						@else
							<li><a href="{{ $url }}" class="pagination-link">{{ $page }}</a></li>
						@endif
					@endforeach
				@endif
			@endforeach
		</ul>
	</nav>

@endif
