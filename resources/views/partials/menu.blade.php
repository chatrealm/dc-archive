<aside class="menu">
	@foreach($menu as $group)
		@if($group['label'])
			<p class="menu-label">{{ $group['label'] }}</p>
		@endif
		<ul class="menu-list">
			@foreach($group['items'] as $item)
				<li>
					<a href="{{ $item['url'] }}"{!! (isset($item['active']) && str_is($item['active'], Route::currentRouteName())) ? ' class="is-active"' : '' !!}>
						{{ $item['text'] }}
					</a>
				</li>
			@endforeach
		</ul>
	@endforeach
</aside>
