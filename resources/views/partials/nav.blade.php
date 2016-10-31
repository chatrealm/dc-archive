<div class="nav has-shadow">
	<div class="container">
		<div class="nav-left">
			<a class="nav-item is-brand" href="{{ route('home') }}">&lt;&gt; Archives</a>
			<a class="nav-item" href="{{ route('browse') }}">Browse</a>
		</div>
		<div class="nav-right">
			@if (Auth::guest())
				<a class="nav-item" href="{{ url('/login') }}">Login</a>
				<a class="nav-item" href="{{ url('/register') }}">Register</a>
			@else
				<div class="nav-item">
					{{ Auth::user()->username }}
				</div>
				@can ('is-admin')
					<a href="{{ route('admin.index') }}" class="nav-item">Admin</a>
				@endcan
				<a href="{{ url('/logout') }}" class="nav-item"
					onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					Logout
				</a>
				<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			@endif
		</div>
	</div>
</div>
