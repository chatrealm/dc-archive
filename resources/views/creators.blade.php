@extends('layouts.app')

@section('content')
<section class="section">
	<div class="container">
		<div class="heading">
			<h2 class="title is-2">The diamonds</h2>
		</div>
		@if($people->has(3))
			<h3 class="subtitle is-4">&lt;core&gt;</h3>
			<div class="columns">
				@foreach ($people->get(3) as $person)
					@include('partials.person-box', [
						'person' => $person
					])
				@endforeach
			</div>
		@endif
		@if($people->has(2))
			<h3 class="subtitle is-4">&lt;stream team&gt;</h3>
		@endif
	</div>
</section>
@endsection
