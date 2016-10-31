@extends('layouts.app')

@section('content')
<div class="responsive-fullwidth-embed">
	<iframe src="https://www.youtube.com/embed/{{ $video->youtube_id }}" frameborder="0" allowfullscreen></iframe>
</div>
<section class="section">
	<div class="container">
		<div class="heading">
			<h2 class="title is-2">{{ $video->title }}</h2>
		</div>

		<div class="columns">
			<div class="column is-two-thirds">
				<!-- wide content -->
			</div>
			<div class="column is-one-third">
				<p>
					Published
					@include('partials.time', ['time' => $video->published_at])
				</p>
			</div>
		</div>

	</div>
</section>
@endsection
