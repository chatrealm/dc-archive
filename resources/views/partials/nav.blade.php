<nav-bar inline-template>
	<nav class="navbar is-primary {{ $navclass or '' }}">
		<div class="container">
			<div class="navbar-brand">
				<a href="{{ route('home') }}" class="navbar-item{{ Route::is('home') ? ' is-active' : '' }}">
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
					<a class="navbar-item{{ Route::is('browse') ? ' is-active' : '' }}" href="{{ route('browse') }}">Browse</a>
				</div>
				<div class="navbar-end">
					<hr class="navbar-divider is-block-touch">
					@if (Auth::guest())
						@if (config('dctv.show_login'))
							<a class="navbar-item{{ Route::is('login') ? ' is-active' : '' }}" href="{{ route('login') }}">Login</a>
							<a class="navbar-item{{ Route::is('register') ? ' is-active' : '' }}" href="{{ route('register') }}">Register</a>
						@endif
					@else
						<div class="navbar-item">
							{{ Auth::user()->username }}
						</div>
						@can ('is-admin')
							<a href="{{ route('admin.index') }}" class="navbar-item{{ Route::is('admin.**') ? ' is-active' : '' }}">Admin</a>
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
</nav-bar>
