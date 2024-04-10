<h4>Available Groups</h4>
<div class="well">
	<table class="table">
		<thead>
			<th>Name</th>
			<th>Permissions</th>
			<th>Options</th>
		</thead>
		<tbody>
		@foreach ($allGroups as $group)
			<tr>
				<td>{{ $group->name }}</td>


				<td>

                    @foreach ($group['permissions'] as $role => $permission)
                    <pre>
                        {{ $role }} = {{ $permission }}
                        {{($role == 'admin' and $permission == 1) ? 'Admin' : ''}}
                    </pre>
                    @endforeach

                   </td>
				<td><button class="btn" onClick="location.href='{{ URL::to('admin/groups') }}/{{ $group->id }}/edit'">Edit</button>
				 	<button class="btn action_confirm {{ ($group->id == 2) ? 'disabled' : '' }}" data-method="delete" href="{{ URL::to('admin/groups') }}/{{ $group->id }}">Delete</button></td>
			</tr>	
		@endforeach
		</tbody>
	</table> 
	 <button class="btn btn-info" onClick="location.href='{{ URL::to('admin/groups/create') }}'">New Group</button>
</div>