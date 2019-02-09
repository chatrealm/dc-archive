@extends('layouts.app')

@section('content')
<section class="section">
	<div class="container">
		<div class="heading">
			<h2 class="title is-2">The diamonds</h2>
		</div>
		@if($people->has(3))
			<h3 class="subtitle is-4">&lt;creators&gt;</h3>
			<div class="columns is-multiline">
				@foreach ($people->get(3) as $person)
					@include('includes.person-box', [
						'person' => $person,
						'wrapperClass' => 'column is-half'
					])
				@endforeach
			</div>
		@endif
		@if($people->has(2))
			<h3 class="subtitle is-4">&lt;stream team&gt;</h3>
			<div class="columns is-multiline">
				@foreach ($people->get(2) as $person)
					@include('includes.person-box', [
						'person' => $person,
						'wrapperClass' => 'column is-half'
					])
				@endforeach
			</div>
		@endif
	</div>
</section>
@endsection
