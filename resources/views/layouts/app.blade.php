@extends('layouts.navless')

@section('content')
	@include('partials.nav')

	@yield('content')
@overwrite
