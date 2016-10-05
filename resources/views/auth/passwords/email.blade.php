@extends('layouts.fullpage')

<!-- Main Content -->
@section('content')
	<div class="container">
		<div class="columns">
			<div class="column is-half is-offset-one-quarter">
				<div class="box">
					<h3 class="title">Reset Password</h3>
					@if (session('status'))
						<div class="notification is-success">
							{{ session('status') }}
						</div>
					@endif

					{!! form($form) !!}
				</div>
			</div>
		</div>
	</div>
@endsection
