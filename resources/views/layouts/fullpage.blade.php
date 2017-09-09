<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Diamond Club') }}</title>

	<!-- Styles -->
	<link href="{{ mix('/build/app.css') }}" rel="stylesheet">
</head>
<body class="no-js">
	<div id="app" class="hero is-fullheight">
		<div class="hero-head">
			@include('partials.nav')
		</div>

		<div class="hero-body">
			@yield('content')
		</div>
	</div>

	<!-- Scripts -->
	<script src="{{ mix('/build/app.js') }}"></script>
</body>
</html>
