<script>
    var d1 = [
        [1196463600000, 2],[1196550000000, 22],[1196636400000, 68],[1196722800000, 127],[1196809200000, 136],[1196895600000, 175],[1196982000000, 236],
        [1197068400000, 286],[1197154800000, 376],[1197241200000, 405],[1197327600000, 406],[1197414000000, 410],[1197500400000, 339],[1197586800000, 440],
        [1197673200000, 435],[1197759600000, 301],[1197846000000, 575],[1197932400000, 481],[1198018800000, 591],[1198105200000, 608],[1198191600000, 459],
        [1198278000000, 234],[1198364400000, 352],[1198450800000, 686],[1198537200000, 279],[1198623600000, 449],[1198710000000, 468],[1198796400000, 392],
        [1198882800000, 282],[1198969200000, 208],[1199055600000, 229],[1199142000000, 177],[1199228400000, 374],[1199314800000, 436],[1199401200000, 404],
        [1199487600000, 253],[1199574000000, 218],[1199660400000, 476],[1199746800000, 462],[1199833200000, 448],[1199919600000, 442],[1200006000000, 403],
        [1200092400000, 204],[1200178800000, 194],[1200265200000, 327],[1200351600000, 374],[1200438000000, 507],[1200524400000, 546],[1200610800000, 482],
        [1200697200000, 283],[1200783600000, 221],[1200870000000, 483],[1200956400000, 523],[1201042800000, 528],[1201129200000, 483],[1201215600000, 452],
        [1201302000000, 670],[1201388400000, 722],[1201474800000, 839],[1201561200000, 859],[1201647600000, 721],[1201734000000, 977],[1201820400000, 642],
        [1201906800000, 252],[1201993200000, 236],[1202079600000, 525],[1202166000000, 477],[1202252400000, 386],[1202338800000, 409],[1202425200000, 408],
        [1202511600000, 637],[1202598000000, 493],[1202684400000, 357],[1202770800000, 414],[1202857200000, 393],[1202943600000, 353],[1203030000000, 364],
        [1203116400000, 215],[1203202800000, 214],[1203289200000, 356],[1203375600000, 399],[1203462000000, 334],[1203548400000, 348],[1203634800000, 243],
        [1203721200000, 126],[1203807600000, 157],[1203894000000, 288]
    ];
    var d2 = [
        [1196463600000, 2],[1196550000000, 20],[1196636400000, 28],[1196722800000, 37],[1196809200000, 76],[1196895600000, 75],[1196982000000, 46],
        [1197068400000, 06],[1197154800000, 76],[1197241200000, 05],[1197327600000, 06],[1197414000000, 10],[1197500400000, 19],[1197586800000, 40],
        [1197673200000, 25],[1197759600000, 21],[1197846000000, 75],[1197932400000, 81],[1198018800000, 91],[1198105200000, 08],[1198191600000, 89],
        [1198278000000, 104],[1198364400000, 52],[1198450800000, 86],[1198537200000, 79],[1198623600000, 49],[1198710000000, 68],[1198796400000, 92],
        [1198882800000, 82],[1198969200000, 08],[1199055600000, 29],[1199142000000, 77],[1199228400000, 74],[1199314800000, 36],[1199401200000, 04],
        [1199487600000, 53],[1199574000000, 18],[1199660400000, 76],[1199746800000, 62],[1199833200000, 48],[1199919600000, 42],[1200006000000, 03],
        [1200092400000, 04],[1200178800000, 94],[1200265200000, 27],[1200351600000, 74],[1200438000000, 07],[1200524400000, 46],[1200610800000, 82],
        [1200697200000, 83],[1200783600000, 21],[1200870000000, 83],[1200956400000, 23],[1201042800000, 28],[1201129200000, 83],[1201215600000, 52],
        [1201302000000, 70],[1201388400000, 22],[1201474800000, 39],[1201561200000, 59],[1201647600000, 21],[1201734000000, 77],[1201820400000, 42],
        [1201906800000, 52],[1201993200000, 36],[1202079600000, 25],[1202166000000, 77],[1202252400000, 86],[1202338800000, 09],[1202425200000, 08],
        [1202511600000, 37],[1202598000000, 93],[1202684400000, 57],[1202770800000, 14],[1202857200000, 93],[1202943600000, 53],[1203030000000, 64],
        [1203116400000, 15],[1203202800000, 14],[1203289200000, 56],[1203375600000, 99],[1203462000000, 34],[1203548400000, 48],[1203634800000, 43],
        [1203721200000, 26],[1203807600000, 57],[1203894000000, 88]
    ];
</script>

<div class="row-fluid page-head">
    <h2 class="page-title"><i class="fontello-icon-monitor"></i> Administrators <small>Dashboard</small></h2>
    <p class="pagedesc">Administrators - Dashboard </p>
    <div class="page-bar">
        <div class="btn-toolbar"> </div>
    </div>
</div>
<!-- // page head -->


<div id="page-content" class="page-content">

<section>
    <div class="row-fluid margin-top20">
        <div class="span12 well well-black">
            <div class="row-fluid">
                <div class="span6 grider">
                    <h3><i class="fontello-icon-chart-bar-3"></i> Daily VISIT <small>{{ date('M') }} <strong>{{ date('D') }}</strong></small></h3>
                    <p class="pagedesc">Statistical sample chart with jQuery Flot graphs. The content below are loaded using inline data.</p>
                    <hr class="margin-mx">
                    <div id="dashChartVisitors" style="width:100%; height:170px" class="margin-bottom32"> </div>
                    <!-- // Chart 1 -->
                    <div id="dashChartVisitorsOverview" style="width:99%;height:45px"> </div>
                    <!-- // Chart 2 -->
                    <p class="info-block">To zoom in, select the area or use the button.</p>
                    <ul class="btn-toolbar">
                        <li><a id="setLastHours" class="btn btn-green">last 24 hours</a></li>
                        <li><a id="setLastSevenDays" class="btn btn-green">last 7 days</a> </li>
                        <li><a id="setLastFortnight" class="btn btn-green">last 14 days</a> </li>
                        <li><a id="clearSelection" class="btn btn-red">Clear</a> </li>
                        <li><a class="btn btn-grey" href="#">View details &raquo;</a> </li>
                    </ul>
                    <hr class="mm" />
                    <!-- // Chart block -->

                </div>
                <!-- // column -->

                <div class="span6 grider">
                    <div class="row-fluid">
                        <div class="span6 grider-item">
                            <div class="row-fluid">
                                <div class="span12 grider-item">
                                    <div class="statistic-box well well-black">
                                        <div class="section-title">
                                            <h5><i class="fontello-icon-back-in-time"></i> Activity</h5>
                                        </div>
                                        <div class="section-content item">
                                            <h4 class="statistic-values pull-left padding-right10"> <span class="section-icon"><i class="fontello-icon-monitor"></i></span> 84% </h4>
                                            <span> Desktop</span> </div>
                                        <div class="section-content">
                                            <h4 class="statistic-values pull-left padding-right10"> <span class="section-icon"><i class="fontello-icon-mobile"></i></span> 16% </h4>
                                            <span> Mobile</span> </div>
                                    </div>
                                    <!-- // box -->
                                </div>
                                <!-- // column -->
                            </div>
                            <!-- // Example row -->

                            <div class="row-fluid">
                                <div class="span12 grider-item">
                                    <ul class="nav nav-well">
                                        <li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-users"></i>
                                                <h4 class="statistic-values pull-right">{{$users}}</h4>
                                                Total Users</a></li>
                                        <li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-user-4"></i>
                                                <h4 class="statistic-values pull-right">21</h4>
                                                New Users (last week)</a></li>
                                        <li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-basket-2"></i>
                                                <h4 class="statistic-values pull-right">15 487</h4>
                                                Total Shop Items</a></li>
                                        <li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-archive"></i>
                                                <h4 class="statistic-values pull-right">69 789</h4>
                                                Total Orders</a></li>
                                        <li><a class="well well-black positive" href="javascript:void(0);"><i class="fontello-icon-download"></i>
                                                <h4 class="statistic-values pull-right">9</h4>
                                                Pending Orders</a></li>
                                        <li><a class="well well-black negative" href="javascript:void(0);"><i class="fontello-icon-lifebuoy"></i>
                                                <h4 class="statistic-values pull-right">4</h4>
                                                Customer Support</a></li>
                                    </ul>
                                    <!-- // statistic nav -->
                                </div>
                                <!-- // column -->
                            </div>
                            <!-- // Example row -->

                        </div>
                        <!-- // column -->

                        <div class="span6 grider-item">
                            <div class="row-fluid">
                                <div class="span12 grider-item">
                                    <div class="statistic-box well well-black well-impressed">
                                        <div class="section-title">
                                            <h5><i class="fontello-icon-users"></i> Total trafic</h5>
                                        </div>
                                        <div class="section-content">
                                            <h2 class="statistic-values">22,266 <span class="negative"><i class="indicator fontello-icon-down-dir"></i><sub>-708</sub></span></h2>
                                            <span class="info-block">Total Trafic Previous 30 days: 21,558</span> </div>
                                    </div>
                                    <!-- // box -->
                                </div>
                                <!-- // column -->
                            </div>
                            <!-- // Example row -->

                            <div class="row-fluid">
                                <div class="span12 grider-item">
                                    <div class="statistic-box well well-black well-impressed">
                                        <div class="section-title">
                                            <h5><i class="fontello-icon-user"></i> Unique Visits</h5>
                                        </div>
                                        <div class="section-content">
                                            <h2 class="statistic-values">14,746 <span class="positive"><i class="indicator fontello-icon-up-dir"></i><sup>+4,460</sup></span></h2>
                                            <span class="info-block">Unique Visits Previous 30 days: 10,268</span> </div>
                                    </div>
                                    <!-- // box -->
                                </div>
                                <!-- // column -->
                            </div>
                            <!-- // Example row -->

                            <div class="row-fluid">
                                <div class="span12 grider-item">
                                    <div class="statistic-box well well-black well-impressed">
                                        <div class="section-title">
                                            <h5><i class="fontello-icon-user"></i> Unique Visits</h5>
                                        </div>
                                        <div class="section-content">
                                            <h2 class="statistic-values">14,746 <span class="positive"><i class="indicator fontello-icon-up-dir"></i><sup>+4,460</sup></span></h2>
                                            <span class="info-block">Unique Visits Previous 30 days: 10,268</span> </div>
                                    </div>
                                    <!-- // box -->
                                </div>
                                <!-- // column -->
                            </div>
                            <!-- // Example row -->

                        </div>
                        <!-- // column -->

                    </div>
                    <!-- // Example row -->
                </div>
                <!-- // column -->

            </div>
        </div>
        <!-- // column -->

    </div>
    <!-- // Example row -->
</section>

</div>