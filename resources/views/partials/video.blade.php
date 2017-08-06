<article class="media">
	<figure class="media-left is-3">
		<a href="{{ route('video', ['video' => $video]) }}">
			<p class="image is-16by9">
				<img src="{{ $video->thumbnail }}" alt="{{ $video->title }}">
				<span class="corner-text">
					{{ secondsToHuman($video->duration) }}
				</span>
			</p>
		</a>
	</figure>
	<div class="media-content is-9">
		<h3 class="title is-3 is-marginless">
			<a href="{{ route('video', ['video' => $video]) }}">{{ $video->title }}</a>
		</h3>
		<em>Published <time>{{ $video->published_at->diffForHumans() }}</time></em>
		<p>Channel: {{ $video->channel->name }}</p>
	</div>
</article>
