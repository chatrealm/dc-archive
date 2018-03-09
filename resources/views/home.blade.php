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

				<live-streams-boxed livehub-url="{{ config('dctv.livehub') }}" />
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
						<h3 class="title is-4">Join The Conversation</h3>
						<a href="http://irc.chatrealm.net" class="multiline-box">
							<div class="multiline-box-title">IRC</div>
							<div class="multiline-box-tagline">irc.chatrealm.net #chat</div>
						</a>
						<a href="https://discordapp.com/invite/0vQgQWIkKVUryD0z" class="multiline-box">
							<div class="multiline-box-title">Discord</div>
							<div class="multiline-box-tagline">It's kinda like IRC</div>
						</a>
						<a href="https://calendar.google.com/calendar/b/0?cid=YTVqZWI5dDVldGFzcmJsNmR0NWh0a3Y0dG9AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ" class="multiline-box">
							<div class="multiline-box-title">Calendar</div>
							<div class="multiline-box-tagline">Be aware. Be very aware.</div>
						</a>
					</div>
				</div>
			</div>
		</section>

@endsection
