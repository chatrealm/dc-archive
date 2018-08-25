@extends('layouts.admin')

@section('content')
	<div class="level">
		<div class="level-left">
			<h3 class="title is-3">Channels</h3>
		</div>
		<div class="level-right">
			<a href="{{ route('admin.channel.create') }}" class="button">
				<span class="icon">
					<i class="material-icons">add</i>
				</span>
				<span>Add Channel</span>
			</a>
		</div>
	</div>

	<table class="table">
		<colgroup>
			<col style="width: 10%;">
			<col style="width: 60%;">
			<col style="width: 30%;">
			<col>
		</colgroup>
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>URL</th>
			<th></th>
			<th></th>
		</thead>
		<tfoot>
			<th>ID</th>
			<th>Name</th>
			<th>URL</th>
			<th></th>
			<th></th>
		</tfoot>
		<tbody>
			@forelse($channels as $channel)
				<tr>
					<td>{{ $channel->id }}</td>
					<td>{{ $channel->name }}</td>
					<td><a href="{{ $channel->url }}">Youtube</a></td>
					<td class="is-icon">
						<a href="{{ route('admin.channel.show', ['channel' => $channel->id]) }}" title="Info">
							<span class="icon"><i class="material-icons">description</i></span>
						</a>
					</td>
					<td class="is-icon">
						<a href="{{ route('admin.channel.edit', ['channel' => $channel->id]) }}" title="Edit">
							<span class="icon"><i class="material-icons">edit</i></span>
						</a>
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="5">No channels Found</td>
				</tr>
			@endforelse
		</tbody>
	</table>

	{{ $channels->links() }}
@endsection
