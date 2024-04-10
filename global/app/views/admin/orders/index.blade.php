<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fontello-icon-folder-2"></i> Orders <small>Management</small></h2>
    <!--<p class="pagedesc">page desc here </p> -->
    <div class="page-bar">
        <div class="btn-toolbar">
            <ul class="nav nav-tabs pull-right">
                <li class="active" id="demo1-tab"> <a href="#TabTop1" data-toggle="tab">Show Orders</a> </li>
                <li id="demo2-tab"> <a href="#TabTop2" data-toggle="tab">Orders History</a> </li>
            </ul>
        </div>
    </div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content tab-content">
    <div id="TabTop1" class="tab-pane active">
        <section>
            <div class="row-fluid">
                <div class="span8">
                    <table id="Orders" class="table boo-table table-bordered table-condensed table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Order </th>
                            <th scope="col">Customer</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(empty($orders))
                        <tr>
                            <td class="dataTables_empty" colspan="6"> No record found <button class="btn btn-danger resetTable">Reset filter</button> </td>
                        </tr>

                        @else

                        @foreach($orders as $order)

                        <tr>
                            <td>ID #{{ $order->id }}</td>
                            <td>{{ Sentry::findUserById($order->user_id)->first_name }}</td>
                            <td>{{ DB::table('order_items')->where('order_id',$order->id)->sum('quantity') }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <i class="fontello-icon-magic"></i>
                                <a href="#">Manage</a>
                                <i class="fontello-icon-cancel-2"></i>
                                <a href="#">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        @endif

                        </tbody>
                    </table>
                </div>

                <div class="span4">
                    <div class="widget widget-simple widget-collapsible bg-green-light">
                        <div data-target="#demoGreen" data-toggle="collapse" class="widget-header header-small clickable">
                            <h4><i class="fontello-icon-window"></i> Order <small>Status</small></h4>
                            <div class="widget-tool"><span class="btn btn-glyph btn-link widget-toggle-btn fontello-icon-publish"></span></div>
                        </div>
                        <div class="widget-content collapse in" id="demoGreen">
                            <div class="widget-body">
                                <div class="widget-row">
                                    <p>your orders in pending status still under review.</p>
                                </div>
                                <div class="widget-row">
                                    <p>Once it get the approval , you will have "view" link in table to show what you got</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- // Widget -->

                </div>
            </div>
            <!-- // Example row -->
        </section>
    </div>
    <div id="TabTop2" class="tab-pane">
        <section>
            <div class="page-header">
                <h3><i class="fontello-icon-folder-2 opaci35"></i> Add <small>Page</small></h3>
            </div>
            <div class="row-fluid">
                <div class="span12">

                </div>
            </div>
            <!-- // Example row -->
        </section>
    </div>
</div>
<!-- // page content -->

<script>
    $(document).ready(function() {

        var table = $('#Orders');
        table.dataTable({
            "bSort": true,
            'bStateSave': true,
            'sDom' : "<'row-fluid'<'widget-header'<'span6'l><'span6'f>>>rt<'row-fluid'<'widget-footer'<'span6'><'span6'p>>"
        });
    } );
</script>