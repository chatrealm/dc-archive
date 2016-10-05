@extends('layouts.fullpage')

@section('content')
	<div class="container">
		<div class="columns">
			<div class="column is-half is-offset-one-quarter">
				<div class="box">
					<h3 class="title">Register</h3>

					{!! form($form) !!}
				</div>
			</div>
		</div>
	</div>
@endsection
