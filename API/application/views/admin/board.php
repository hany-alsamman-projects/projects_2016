
<link type="text/css" rel="stylesheet" href="css/dashboard.css"/>

<!-- Load the AJAX API-->
<script type="text/javascript"
        src='http://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1"}]}'>
</script>

<script>
    var chartInit = false,
        drawVisitorsChart = function()
        {
            // Create our data table.
            var data = new google.visualization.DataTable();
            var raw_data =
                [
                    ['Members', 10,10,10,10,10,10,10,10,10,10,10,10],
                    ['Requestes', 4,10,5,10,4,7,8,10,7,2,1,4]
                ];

    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    data.addColumn('string', 'Month');
    for (var i = 0; i < raw_data.length; ++i)
    {
        data.addColumn('number', raw_data[i][0]);
    }

    data.addRows(months.length);

    for (var j = 0; j < months.length; ++j)
    {
        data.setValue(j, 0, months[j]);
    }
    for (var i = 0; i < raw_data.length; ++i)
    {
        for (var j = 1; j < raw_data[i].length; ++j)
        {
            data.setValue(j-1, i+1, raw_data[i][j]);
        }
    }

    // Create and draw the visualization.
    // Learn more on configuration for the LineChart: http://code.google.com/apis/chart/interactive/docs/gallery/linechart.html
    var div = $('#demo-chart'),
        divWidth = div.width();
    new google.visualization.LineChart(div.get(0)).draw(data, {
        title: '',
        width: divWidth,
        height: 265,
        legend: 'left',
        yAxis: {title: '(thousands)'},
        backgroundColor: 'transparent',	// IE8 and lower do not support transparency
        legendTextStyle: { color: 'white' },
        titleTextStyle: { color: 'white' },
        hAxis: {
            textStyle: { color: 'white' }
        },
        vAxis: {
            textStyle: { color: 'white' },
            baselineColor: '#666666'
        },
        chartArea: {
            top: 35,
            right: 30,
            width: divWidth-40
        },
        legend: 'bottom'
    });

    // Ready
    chartInit = true;
    };

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages': ['corechart'] });

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawVisitorsChart);


    // Respond.js hook (media query polyfill)
    $(document).on('respond-ready', drawVisitorsChart);

</script>


<div class="dashboard">

    <div class="columns">

        <div style="width: 70%; float: right"  id="demo-chart">
            <!-- This div will hold the chart generated in the footer -->
        </div>

        <div style="width: 27%; margin-right: 20px;  float: left">
            <ul class="stats split-on-mobile">
                <li><a href="#">
                        <strong><?= $total_users ?></strong> Total Users
                    </a></li>
                <li>
                    <strong><?= $waiting_users ?></strong> Members awaiting activation
                </li>
                <li><a href="#">
                        <strong><?= $vt_requestes ?></strong> Total Requestes
                    </a></li>
                <li>
                    <strong><?= $waiting_requestes ?></strong> Requestes awaiting <br> approval
                </li>
            </ul>
        </div>

    </div>

</div>