<nav class="navbar is-primary {{ $navclass ?? '' }}">
	<div class="container">
		<div class="navbar-brand">
			<a href="{{ route('home') }}" class="navbar-item{{ Route::is('home') ? ' is-active' : '' }}">
				<img src="{{ mix('build/images/DCTV-Logo.svg') }}" alt="DiamondClub.tv">
			</a>

			<div class="navbar-burger" data-target="nav-main-menu">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div id="nav-main-menu" class="navbar-menu">
			<div class="navbar-start">
				<a class="navbar-item{{ Route::is('browse') ? ' is-active' : '' }}" href="{{ route('browse') }}">Browse</a>
			</div>
			<div class="navbar-end">
				@if (Auth::guest())
					@if (config('dctv.show_login'))
						<hr class="navbar-divider is-block-touch">
						<a class="navbar-item{{ Route::is('login') ? ' is-active' : '' }}" href="{{ route('login') }}">Login</a>
						<a class="navbar-item{{ Route::is('register') ? ' is-active' : '' }}" href="{{ route('register') }}">Register</a>
					@endif
				@else
					<hr class="navbar-divider is-block-touch">
					<div class="navbar-item">
						{{ Auth::user()->username }}
					</div>
					@can ('is-admin')
						<a href="{{ route('code16.sharp.home') }}" class="navbar-item">Admin</a>
					@endcan
					<a href="{{ route('logout') }}" class="navbar-item"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						Logout
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				@endif
			</div>
		</div>
	</div>
</nav>
