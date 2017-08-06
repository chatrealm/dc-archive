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
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link href="{{ elixir('assets/app.css') }}" rel="stylesheet" />
</head>
<body class="no-js">
	<div id="app">
		@include('partials.nav')

		@yield('content')
	</div>

	<!-- Scripts -->
	<script src="{{ elixir('assets/app.js') }}"></script>
</body>
</html>
