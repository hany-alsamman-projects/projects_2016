<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fontello-icon-folder-2"></i> Departments <small>Management</small></h2>
    <!--<p class="pagedesc">page desc here </p> -->
    <div class="page-bar">
        <div class="btn-toolbar">
            <ul class="nav nav-tabs pull-right">
                <li class="active" id="demo1-tab"> <a href="#TabTop1" data-toggle="tab">Show Departments</a> </li>
                <li id="demo2-tab"> <a href="#TabTop2" data-toggle="tab">Add Department</a> </li>
            </ul>
        </div>
    </div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content tab-content">
    <div id="TabTop1" class="tab-pane active">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i>Show <small>Departments</small></h3>
            </div>
            <div class="row-fluid">
                <div class="span10">

                    <table id="departments" class="table boo-table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Main DEPT</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(empty($depts))
                        <tr>
                            <td class="dataTables_empty" colspan="6"> No record found <button class="btn btn-danger resetTable">Reset filter</button> </td>
                        </tr>

                        @else

                        @foreach($depts as $dept)

                        <tr>
                            <td>{{ $dept->id }}</td>
                            <td>{{ $dept->title }}</td>
                            <td>{{ $dept->slug }}</td>
                            <td>@if($dept->parent)  {{ Category::where('parent', $dept->parent)->first()->title; }} @endif</td>
                            <td class="hidden-phone">
                                <i class="fontello-icon-edit-2"></i>
                                <a href="{{ URL::to("admin/dept/$dept->id/edit") }}">Edit</a>&nbsp;
                                <i class="fontello-icon-folder-open"></i>
                                <a href="{{ URL::to("admin/product/product-by-dept/$dept->id") }}">Browse</a>&nbsp;
                                <i class="fontello-icon-cancel-2"></i>
                                <a href="{{ URL::to("admin/dept/$dept->id/delete") }}">Delete</a>
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
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i> Add <small>Department</small></h3>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    @include('admin/dept/create')
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