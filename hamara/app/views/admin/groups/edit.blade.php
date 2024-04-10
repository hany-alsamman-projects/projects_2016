<h4>Edit Group</h4>
<div class="well">
	<form class="form-horizontal" action="{{ URL::to('admin/groups') }}/{{ $group['id'] }}" method="POST">
        {{ Form::token() }}
        <input type="hidden" name="_method" value="PUT">

        <div class="control-group {{ ($errors->has('name')) ? 'error' : '' }}" for="name">
            <label class="control-label" for="name">Name</label>
            <div class="controls">
                <input name="name" value="{{ (Request::old('name')) ? Request::old('name') : $group->name }}" type="text" class="input-xlarge" placeholder="Name">
                {{ ($errors->has('name') ? $errors->first('name') : '') }}
            </div>
        </div>

        <div class="control-group" for="permissions">
            <label class="control-label" for="permissions">Permissions</label>
            <div class="controls">

                @foreach ($group['permissions'] as $role => $permission)
                <p>
                <label >{{ $role }}</label>

                {{ Form::checkbox($role, $permission, ($permission == 1) ? true : false, array('class'=>'switch tiny')) }}
                </p>
                @endforeach

            </div>
        </div>
        
        <div class="form-actions">
            <button class="button" type="submit">Save Changes</button>
        </div>
  </form>
</div>