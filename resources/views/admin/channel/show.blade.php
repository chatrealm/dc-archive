@extends('layouts.admin')

@section('content')
	<div class="level">
		<div class="level-left">
			<h3 class="title is-3">Channel - {{ $channel->name }}</h3>
		</div>
		<div class="level-right">
			<div class="control">
				<a href="{{ route('admin.channel.index') }}" class="button">
					<span class="icon">
						<i class="material-icons">arrow_back</i>
					</span>
					<span>Back</span>
				</a>
				<a href="{{ route('admin.channel.edit', ['channel_id' => $channel->id]) }}" class="button">
					<span class="icon">
						<i class="material-icons">edit</i>
					</span>
					<span>Edit</span>
				</a>
			</div>
		</div>
	</div>

	<table class="table">
		<tbody>
			<tr>
				<th>Youtube Channel:</th>
				<td>
					<a href="{{ $channel->url }}">{{ $channel->youtube_id }}</a>
				</td>
			</tr>
			<tr>
				<th>Uploads playlist:</th>
				<td>
					<a href="{{ $channel->playlist_url }}">{{ $channel->uploads_playlist }}</a>
				</td>
			</tr>
			<tr>
				<th>Last Checked:</th>
				<td>
					@if ($channel->last_updated)
						@include('partials.time', ['time' => $channel->last_updated])
					@else
						<em>Never</em>
					@endif
				</td>
			</tr>
		</tbody>
	</table>
@endsection
