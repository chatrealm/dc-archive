@extends('layouts.admin')

@section('content')
	<h3 class="title">Edit Channel</h3>

	{!! form($form) !!}

	<h4 class="subtitle">Delete Channel</h4>

	{!! form($deleteForm) !!}
@endsection
