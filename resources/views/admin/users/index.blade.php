@extends('layouts.admin')

@section('content')
	<table class="table">

		<thead>
			<th>ID</th>
			<th>Username</th>
			<th>Admin</th>
		</thead>
		<tfoot>
			<th>ID</th>
			<th>Username</th>
			<th>Admin</th>
		</tfoot>
		<tbody>
			@forelse($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->username }}</td>
					<td class="is-icon">
						@if ($user->is_admin)
							<i class="material-icons">check</i>
						@endif
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="3">No Users Found</td>
				</tr>
			@endforelse
		</tbody>
	</table>

	{{ $users->links() }}
@endsection()
