@extends('layouts.navless')

@section('content')
	@include('partials.nav')

	<div class="app-content">
		@yield('content')
	</div>
@overwrite
