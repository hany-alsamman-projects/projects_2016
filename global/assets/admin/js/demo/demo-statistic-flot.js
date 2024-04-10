$(document).ready(function () {
    demo_statistic_chart.chartLines_B();
});

var coloursChart = ["#edc240", "#61ba61", "#1083c7", "#db6464", "#ff9933", "#009999"]

// CHARTS SETTINGS
// ------------------------------------------------------------------------------------------------ * -->
demo_statistic_chart = {
    // ----------------------------------------- * -->
    chartLines_B: function () {
        var elem = $('#statChartFlotLineB');

        var d1 = [
            [1, 3 ],
            [2, 5 ],
            [3, 8 ],
            [4, 11 ],
            [5, 14 ],
            [6, 17 ],
            [7, 20 ],
            [8, 14 ],
            [9, 17 ],
            [10, 20 ],
            [11, 23 ],
            [12, 26 ],
            [13, 29 ],
            [14, 32 ],
            [15, 23 ],
            [16, 26 ],
            [17, 29 ],
            [18, 32 ],
            [19, 35 ],
            [20, 38 ],
            [21, 41 ],
            [22, 44 ],
            [23, 35 ],
            [24, 38 ],
            [25, 41 ],
            [26, 44 ],
            [27, 37 ],
            [28, 50 ],
            [29, 54 ],
            [30, 59 ]
        ];
        var d2 = [
            [1, 5],
            [2, 4],
            [3, 4],
            [4, 2],
            [5, 4 ],
            [6, 4 ],
            [7, 5 ],
            [8, 5 ],
            [9, 6 ],
            [10, 6 ],
            [11, 6 ],
            [12, 2 ],
            [13, 3 ],
            [14, 4 ],
            [15, 4 ],
            [16, 4 ],
            [17, 5 ],
            [18, 5 ],
            [19, 2 ],
            [20, 2 ],
            [21, 3 ],
            [22, 3 ],
            [23, 3 ],
            [24, 2 ],
            [25, 4 ],
            [26, 4 ],
            [27, 5 ],
            [28, 2 ],
            [29, 2 ],
            [30, 3 ]
        ];

        var options = {
            legend: {
                position: "nw",
                margin: [5, 5],
                noColumns: 1,
                labelBoxBorderColor: null,
                backgroundColor: false,
            },
            grid: {
                show: true,
                aboveData: true,
                color: "#ccc",
                labelMargin: 5,
                axisMargin: 0,
                borderWidth: 0,
                borderColor: true,
                minBorderMargin: 5,
                clickable: true,
                hoverable: true,
                autoHighlight: true,
                mouseActiveRadius: 20
            },
            series: {
                lines: {
                    show: true,
                    lineWidth: 3.5,
                    fill: true,
                    steps: false
                },
                points: {
                    show: true,
                    radius: 4,
                    fill: true,
                    fillColor: "#333",
                    symbol: "circle"
                },
                grow: {
                    active: true,
                    stepMode: "linear",
                    steps: 5,
                    stepDelay: true
                }
            },
            yaxis: {
                min: 0,
                font: {
                    weight: "bold"
                },
                tickColor: "rgba(255,255,255,0.1)",
            },
            xaxis: {
                ticks: 11,
                tickDecimals: 0,
                font: {
                    weight: "bold"
                },
                tickColor: "rgba(255,255,255,0.1)",
            },
            colors: ["#edc240", "#5EB95E"],
            shadowSize: 1
        };

        $.plot(elem, [{
            label: "Visits",
            data: d1,
            lines: {
                fillColor: "rgba(237,194,64,0.1)"
            }
        }, {
            label: "Unique Visits",
            data: d2,
            lines: {
                //fillColor: "rgba(228,248,228,0.15)"
                fillColor: "rgba(0,0,0,0.15)"
            }
        }], options);

        // Create a tooltip on our chart
        elem.qtip({
            prerender: true,
            content: 'Loading...',
            position: {
                viewport: $(window),
                target: 'mouse',
                adjust: {
                    x: 7
                }
            },
            show: false,
            style: {
                classes: 'ui-tooltip-shadow ui-tooltip-tipsy',
                tip: false
            }
        });

        // Bind the plot hover
        elem.bind("plothover", function (event, coords, item) {
            var self = $(this),
                api = $(this).qtip(),
                previousPoint, content,
                round = function (x) {
                    return Math.round(x * 1000) / 1000;
                };
            if(!item) {
                api.cache.point = false;
                return api.hide(event);
            }
            previousPoint = api.cache.point;
            if(previousPoint !== item.dataIndex) {
                api.cache.point = item.dataIndex;
                content = item.series.label + ' = ' + round(item.datapoint[1]);
                api.set('content.text', content);
                api.elements.tooltip.stop(1, 1);
                api.show(coords);
            }
        });

    }

};