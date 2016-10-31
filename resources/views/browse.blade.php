@extends('layouts.app')

@section('content')
<section class="section">
	<div class="container">
		<h2 class="title is-2">Browse</h2>
		<div class="columns">
			<div class="column is-one-third">
				<!-- Search -->
			</div>
			<div class="column is-two-thirds">
				<div class="block">
					@forelse ($videos as $video)
						@include('partials.video', ['video' => $video])
					@empty
						<p>Empty</p>
					@endforelse
				</div>

				{{ $videos->links() }}
			</div>
		</div>
	</div>
</section>
@endsection
