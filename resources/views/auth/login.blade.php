@extends('layouts.fullpage')

@section('content')
	<div class="container">
		<div class="columns">
			<div class="column is-half is-offset-one-quarter">
				<div class="box">
					<h3 class="title">Login</h3>

					{!! form_start($form) !!}
						{!! form_until($form, 'remember') !!}
						<div class="control">
							{!! form_widget($form->submit, ['wrapper' => false]) !!}
							<a class="button is-link" href="{{ url('/password/reset') }}">
								Forgot Your Password?
							</a>
						</div>
					{!! form_end($form) !!}
				</div>
			</div>
		</div>
	</div>
@endsection
