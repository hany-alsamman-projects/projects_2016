<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fontello-icon-layers"></i> Slides <small>Management</small></h2>
    <!--<p class="pagedesc">page desc here </p> -->
    <div class="page-bar">
        <div class="btn-toolbar">
            <ul class="nav nav-tabs pull-right">
                <li class="active" id="demo1-tab"> <a href="#TabTop1" data-toggle="tab">Show Slides</a> </li>
            </ul>
        </div>
    </div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content tab-content">
    <div id="TabTop1" class="tab-pane active">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i>Show <small>Slides</small></h3>
            </div>
            <div class="row-fluid">
                <div class="span10">

                    <table id="departments" class="table boo-table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Position</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(empty($slides))
                        <tr>
                            <td class="dataTables_empty" colspan="6"> No record found <button class="btn btn-danger resetTable">Reset filter</button> </td>
                        </tr>

                        @else

                        @foreach($slides as $slide)

                        <tr>
                            <td>{{ $slide->id }}</td>
                            <td>{{ $slide->title }}</td>
                            <td>{{ $slide->description }}</td>
                            <td>{{ $slide->position }}</td>
                            <td class="hidden-phone">
                                <i class="fontello-icon-edit-2"></i>
                                <a href="{{ URL::to("admin/slides/$slide->id/edit") }}">Edit</a>&nbsp;
                                <i class="fontello-icon-cancel-2"></i>
                                <a href="{{ URL::to("admin/slides/$slide->id/delete") }}">Delete</a>
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
</div>
<!-- // page content -->

<script>
    $(document).ready(function() {

        var table = $('#departments');

        table.dataTable({
            "bSort": true,
            'bStateSave': true,
            'sDom' : "<'row-fluid'<'widget-header'<'span6'l><'span6'f>>>rt<'row-fluid'<'widget-footer'<'span6'><'span6'p>>"
        });


    } );
</script>