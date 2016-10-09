@if(Session::has('flash.alerts'))
	@foreach(Session::get('flash.alerts') as $alert)

		<div class='notification is-{{ $alert['level'] }}'>
			@if( ! empty($alert['title']))
				<p class="title">{{ $alert['title'] }}</p>
			@endif

			{{ $alert['message'] }}
		</div>

	@endforeach
@endif

