<div class="nav">
	<div class="container">
		<div class="nav-left">
			<a class="nav-item is-brand" href="{{ url('/') }}">&lt;&gt; Archives</a>
			<a class="nav-item" href="#">Browse</a>
		</div>
		<div class="nav-right">
			@if (Auth::guest())
				<a class="nav-item" href="{{ url('/login') }}">Login</a>
				<a class="nav-item" href="{{ url('/register') }}">Register</a>
			@else
				<div class="nav-item">
					{{ Auth::user()->username }}
				</div>
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
