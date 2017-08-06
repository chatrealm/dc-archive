<nav-bar inline-template>
	<nav class="navbar">
		<div class="navbar-brand">
			<a href="{{ route('home') }}" class="navbar-item">
				<img src="{{ asset('static/dctv-logo.png') }}" alt="DiamondClub.tv">
			</a>

			<div class="navbar-burger" @click="isOpen = !isOpen">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div class="navbar-menu" :class="{'is-active': isOpen}">
			<div class="navbar-start">
				<a class="navbar-item" href="{{ route('browse') }}">Browse</a>
			</div>
			<div class="navbar-end">
				<hr class="navbar-divider is-block-touch">
				@if (Auth::guest())
					<a class="navbar-item" href="{{ url('/login') }}">Login</a>
					<a class="navbar-item" href="{{ url('/register') }}">Register</a>
				@else
					<div class="navbar-item">
						{{ Auth::user()->username }}
					</div>
					@can ('is-admin')
						<a href="{{ route('admin.index') }}" class="navbar-item">Admin</a>
					@endcan
					<a href="{{ url('/logout') }}" class="navbar-item"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						Logout
					</a>
					<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				@endif
			</div>
		</div>
	</nav>
</nav-bar>
