<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fontello-icon-folder-2"></i> Users <small>Management</small></h2>
    <!--<p class="pagedesc">page desc here </p> -->
    <div class="page-bar">
        <div class="btn-toolbar">
            <ul class="nav nav-tabs pull-right">
                <li class="active" id="demo1-tab"> <a href="#TabTop1" data-toggle="tab">Show Users</a> </li>
                <li id="demo2-tab"> <a href="#TabTop2" data-toggle="tab">Add User</a> </li>
            </ul>
        </div>
    </div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content tab-content">
    <div id="TabTop1" class="tab-pane active">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i>Show <small>Users</small></h3>
            </div>
            <div class="row-fluid">
                <div class="span10">

                    <table id="users" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Last login</th>
                            <th scope="col">Group</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($users))
                        <tr>
                            <td class="dataTables_empty" colspan="6"> No record found <button class="btn btn-danger resetTable">Reset filter</button> </td>
                        </tr>

                        @else

                        @foreach($users as $user)

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_login }}</td>
                            <td>
                                @foreach ($user->groups()->get() as $group)
                                {{$group->name}}
                                @endforeach
                            </td>
                            <td class="hidden-phone">
                                <!-- <i class="fontello-icon-edit-2"></i>
                                <a href="{{ URL::to("admin/users/$user->id/edit") }}">Edit</a> -->
                                <i class="fontello-icon-cancel-2"></i>
                                <a href="{{ URL::to("admin/users/$user->id/delete") }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- // Example row -->
        </section>
    </div>
    <div id="TabTop2" class="tab-pane">
        <section>

            <div class="row-fluid">
                <div class="span12">
                    @include('admin/users/create')
                </div>
            </div>
            <!-- // Example row -->
        </section>
    </div>
</div>
<!-- // page content -->

<script>
    $(document).ready(function() {

        var table = $('#users');
        table.dataTable({
            "bSort": true,
            'bStateSave': true
        });
    } );
</script>