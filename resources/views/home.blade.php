@extends('layouts.navless')

@section('content')
	<section class="hero is-primary is-bold">
		<div class="hero-head">
			@include('partials.nav', ['navclass' => 'is-transparent'])
		</div>
		<div class="hero-body">
			<div class="container">
				<h1 class="title is-1">Welcome To The Diamond Club</h1>
				<p class="subtitle is-2">Why not watch something live...</p>

				<live-streams-boxed config-url="http://livehub.app/live/config" />
			</div>
		</div>
	</section>

		<section class="section">
			<div class="container">
				<h2 class="title is-3">Or enjoy something else</h2>
				<p class="subtitle is-4">Check out what's happening around chatrealm</p>

				<div class="columns">
					<div class="column is-two-thirds">
						@forelse ($videos as $video)
							@include('partials.video', ['video' => $video])
						@empty
							<p>Chatrealm's quiet lately</p>
						@endforelse
					</div>
					<div class="column is-one-third">
					</div>
				</div>
			</div>
		</section>

@endsection
