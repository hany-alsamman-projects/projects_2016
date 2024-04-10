<section>
    <div class="page-header">
        <h3><i class="fontello-icon-edit opaci35"></i> Wrapped in a DataTable <small>.widget-simple</small></h3>
        <p>Wrap the table in the widget class <code> .widget-simple</code> or <code> .widget-box</code>.</p>
        <p>Approve this order <a class="btn _btn-large btn-green" href=""><i class="fontello-icon-arrows-cw"></i> Approve</a>  or Back to Orders <a class="btn _btn-large btn-gray" href=""><i class="fontello-icon-back"></i>Back</a></p>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget widget-simple widget-table">
                <table id="exampleDTCF" class="table table-striped table-content table-condensed boo-table table-hover bg-blue-light">
                    <caption>
                        Default Table Caption - Title for table <span>Here text in span</span>
                    </caption>
                    <thead>
                    <tr id="HeadersRow0">
                        <th scope="col"><input type="checkbox" class="checkbox check-all" data-tableid="exampleDTCF" value="ON" name="check-all"></th>
                        <th scope="col">Order ID <span class="column-sorter"></span></th>
                        <th scope="col">Customer ID <span class="column-sorter"></span></th>
                        <th scope="col">Order Date <span class="column-sorter"></span></th>
                        <th scope="col">Shipped Date <span class="column-sorter"></span></th>
                        <th scope="col">Freight <span class="column-sorter"></span></th>
                    </tr>
                    <tr id="filter-row" class="filter">
                        <th></th>
                        <th>Order ID</th>
                        <th>Customer ID</th>
                        <th class="hidden-phone hidden-tablet">Order Date</th>
                        <th>Shipped Date</th>
                        <th>Freight</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr id="FootersRow0" class="total">
                        <th></th>
                        <th>Total sum</th>
                        <th></th>
                        <th class="hidden-phone hidden-tablet"></th>
                        <th></th>
                        <th class="text-right"></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr id="DataRow0">
                        <td><input type="checkbox" class="checkbox check-row" value="0" name="checkRow"></td>
                        <td>10248</td>
                        <td>VINET</td>
                        <td>04/08/2012</td>
                        <td>16/08/2012</td>
                        <td>33</td>
                    </tr>
                    <tr id="DataRow0">
                        <td><input type="checkbox" class="checkbox check-row" value="0" name="checkRow"></td>
                        <td>10248</td>
                        <td>VINET</td>
                        <td>04/08/2012</td>
                        <td>16/08/2012</td>
                        <td>33</td>
                    </tr>
                    </tbody>
                </table>
                <!-- // DATATABLE - DTCF -->

            </div>
            <!-- // Widget -->

        </div>
        <!-- // Column -->

    </div>
</section>

<script>
    $(document)
        .ready(function () {

            $('#exampleDTCF')
                .dataTable({
                    bAutoWidth: false,
                    bSortCellsTop: true,
                    BProcessing: true,
                    oLanguage: {
                        sSearch: "Global search: ",
                        sLengthMenu: "Show _MENU_ entries",
                        sZeroRecords: 'No record found <button class="btn btn-danger resetTable">Reset filter</button>'
                    },
                    iDisplayLength: 10,
                    aaSorting: [
                        [3, 'asc']
                    ],
                    aoColumnDefs: [{
                        "aTargets": [0],
                        'bSortable': false,
                        'sWidth': '25px'
                    }, {
                        "aTargets": [1],
                        'sWidth': '65px',
                        'sClass': 'bold'
                    }, {
                        "aTargets": [3],
                        'sClass': 'text-right hidden-phone hidden-tablet',
                        'sType': 'eu_date'
                    }, {
                        "aTargets": [4],
                        'sClass': 'text-right',
                        'sType': 'eu_date'
                    }, {
                        "aTargets": [5],
                        'sClass': 'text-right'
                    }],
                    sPaginationType: 'full_numbers',
                    sDom: "<'row-fluid' <'widget-header' <'span4'l> <'span8'<'table-tool-wrapper'><'table-tool-container'>> > > rti <'row-fluid' <'widget-footer' <'span6' <'table-action-wrapper'>> <'span6'p> >>",

                    fnFooterCallback: function (nRow, aaData, iStart, iEnd, aiDisplay) {
                        var iPageSum = 0;
                        for(var i = iStart; i < iEnd; i++) {
                            iPageSum += aaData[aiDisplay[i]][5] * 1;
                        }
                        var nCells = nRow.getElementsByTagName('th');
                        nCells[5].innerHTML = parseInt(iPageSum * 100) / 100;
                    }
                })
                // Table Filter
                .columnFilter({
                    sPlaceHolder: 'head:after',
                    aoColumns: [
                        null, {
                            type: 'number'
                        }, {
                            type: 'text'
                        }, {
                            type: 'text'
                        }, {
                            type: 'text'
                        }, {
                            type: 'text'
                        }]
                })
                .makeEditable();

            // inject to datatable DTCF
            $('#exampleDTCF_wrapper .table-tool-wrapper')
                .html($('#DTCF_toolBar')
                    .html());
            $('#exampleDTCF_wrapper .table-action-wrapper')
                .html($('#DTCF_actionTable')
                    .html());

            $('#exampleDTCF_length select').select2({
                minimumResultsForSearch: 6,
                width: "off"
            });

});
</script>