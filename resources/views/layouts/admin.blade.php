@extends('layouts.app')

@section('content')
	<section class="section">
		<div class="container">
			<h2 class="title is-2">Admin</h2>

			@include('partials.notifications')

			<div class="columns">
				<div class="column is-one-quarter">
					@include('partials.admin.menu')
				</div>
				<div class="column is-three-quarter">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
@overwrite
