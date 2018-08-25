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
	<link href="{{ mix('/build/app.css') }}" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>
<body class="no-js">
	<div id="app" class="app">
		@yield('content')

		<footer class="footer">
			<div class="container">
				<div class="content has-text-centered">
					<p>Diamond Club hopes you've enjoyed these programmes <em>E-hee-hee-hee</em></p>
				</div>
			</div>
		</footer>
	</div>

	<!-- Scripts -->
	<script src="{{ mix('/build/app.js') }}"></script>
</body>
</html>
