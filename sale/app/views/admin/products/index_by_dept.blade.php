<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fontello-icon-folder-2"></i> News <small>Management</small></h2>
    <!--<p class="pagedesc">page desc here </p> -->
    <div class="page-bar">
        <div class="btn-toolbar">
            <ul class="nav nav-tabs pull-right">
                <li class="active" id="demo1-tab"> <a href="#TabTop1" data-toggle="tab">Show News</a> </li>
                @if(Sentry::getUser()->isSuperUser())
                <li id="demo2-tab"> <a href="#TabTop2" data-toggle="tab">Add News</a> </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content tab-content">
    <div id="TabTop1" class="tab-pane active">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i>Show <small>News</small> in @if($dept_id)  {{ Category::where('id', $dept_id)->first()->title; }} @endif Department</h3>
            </div>
            <div class="row-fluid">
                <div class="span12">

                    <table id="products" class="table boo-table table-bordered table-condensed table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Pub Date</th>
                            <th scope="col" class="hidden-phone hidden-tablet">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($products->isEmpty())
                        <tr>
                            <td class="dataTables_empty" colspan="6"> No record found <button class="btn btn-danger resetTable">Reset filter</button> </td>
                        </tr>

                        @else

                        @foreach($products as $product)

                        <tr>
                            <td>{{ $product->id }}</td>
                            <td  title="{{$product->title}}">
                                @if($product->photo != false)
                                <i class="fontello-icon-picture"></i>
                                <a class="ajaxModal" href="{{asset("assets/data/covers/$product->photo")}}">{{ $product->title }}</a>
                                @else
                                {{ Str::limit($product->title,140) }}
                                @endif
                            </td>
                            <td>{{ $product->created_date }}</td>
                            <td style="width: 100px" class="hidden-phone hidden-tablet">

                                @if(Sentry::getUser()->isSuperUser())
                                <a href="{{ URL::to("admin/product/edit/$product->id") }}"> <i class="fontello-icon-edit-2"></i> Edit</a>
                                <br>
                                <a href="{{ URL::to("admin/product/delete/$product->id") }}"> <i class="fontello-icon-cancel-2"></i> Delete</a>
                                @endif
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
    @if(Sentry::getUser()->isSuperUser())
    <div id="TabTop2" class="tab-pane">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i> Add <small>News</small></h3>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    @include('admin/products/add')
                </div>
            </div>
            <!-- // Example row -->
        </section>
    </div>
    @endif
</div>
<!-- // page content -->

<script>
    $(document).ready(function() {

        var table = $('#products');
        table.dataTable({
            "bSort": true,
            'bStateSave': true,
            'sDom' : "<'row-fluid'<'widget-header'<'span6'l><'span6'f>>>rt<'row-fluid'<'widget-footer'<'span6'><'span6'p>>"
        });


    } );
</script>