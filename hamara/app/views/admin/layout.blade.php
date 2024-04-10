<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>{{ Config::get('settings.site.title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="description" content="">
    <meta name="author" content="{{ Config::get('settings.site.metaauthor') }}">

    <!-- Le styles -->
    {{ HTML::style('assets/admin/css/bootstrap.css') }}
    {{ HTML::style('assets/admin/css/bootstrap-responsive.css') }}
    {{ HTML::style('assets/admin/css/extension.css') }}
    {{ HTML::style('assets/admin/css/main.css') }}
    {{ HTML::style('assets/admin/css/style.css') }}

    <link href="{{asset('assets/admin/css/icon-fugue.min.css')}}" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/selectivizr/selectivizr.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/excanvas/js/excanvas.js')}}"></script>
    <![endif]-->

    <script src="{{asset('assets/admin/libs/modernizr/modernizr-2.6.2/js/modernizr-2.6.2.js')}}"></script>

    <!-- Le fav and touch icons
    <link rel="shortcut icon" href="Content/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="Content/ico/boo-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="Content/ico/boo-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="Content/ico/boo-72.png">
    <link rel="apple-touch-icon-precomposed" href="Content/ico/boo-57.png">
    -->

    <!-- Libraries -->
    <script src="{{asset('assets/admin/libs/jquery/jquery-1.9.1/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/jquery/jquery.migrate-1.1.1/jquery-migrate.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/jquery/jquery.ui.combined-1.10.2/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-system/jquery-cookie/js/jquery.cookie.js')}}"></script>
    <!-- Le javascript -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- System -->
    <script src="{{asset('assets/admin/libs/pl-system/jquery.nicescroll/js/jquery.nicescroll.min.js')}}"></script>

    <script src="{{asset('assets/admin/libs/pl-system/jquery-mousewheel/js/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-system/xbreadcrumbs/js/xbreadcrumbs.js')}}"></script>

    <!-- System info -->
    <script src="{{asset('assets/admin/libs/pl-system-info/bootstrapx-clickover/js/bootstrapx-clickover.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-system-info/gritter/js/jquery.gritter.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-system-info/jquery.notyfy/js/jquery.notyfy.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-system-info/qtip2/js/jquery.qtip.min.js')}}"></script>

    <!-- Form -->
    <script src="{{asset('assets/admin/libs/pl-form/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/select2/js/select2.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/uniform/js/jquery.uniform.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/bootstrap-daterangepicker/js/date.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/bootstrap-daterangepicker/js/bootstrap-daterangepicker.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/jquery.inputmask/js/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/jquery.inputmask/js/jquery.inputmask.custom.extensions.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/jquery.elastic/js/jquery.elastic.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-form/jquery.validation/js/jquery.validate.js')}}"></script>

    <!-- Editors -->

    <!-- Content -->
    <script src="{{asset('assets/admin/libs/pl-content/bootstrap-modal/js/bootstrap-modalmanager.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/bootstrap-modal/js/bootstrap-modal.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/bootbox/js/bootbox.min.js')}}"></script>

    <script src="{{asset('assets/admin/libs/pl-content/rateit/js/jquery.rateit.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/jquery.toolbar/js/jquery.toolbar.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/list/js/list.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/list/js/list.paging.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/list/js/list.fuzzySearch.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/list/js/list.filter.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/jquery.listnav/js/jquery.listnav.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-content/equalize/js/equalize.js')}}"></script>

    <!-- Tables -->
    <script src="{{asset('assets/admin/libs/bootstrap-jasny/js/bootstrap-rowlink.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-table/datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-table/datatables/js/jquery.dataTables.plugins.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-table/datatables/js/jquery.dataTables.columnFilter.js')}}"></script>

    <!-- Data Visualization -->
    <script src="{{asset('assets/admin/libs/pl-visualization/bootstrap-progressbar/js/bootstrap-progressbar.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/sparkline/js/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/flot/js/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/flot/js/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/flot/js/jquery.flot.grow.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/flot/js/jquery.flot.orderBars.js')}}"></script>

</head>

<body class="header-sticky sidebar-left">
<div class="page-container">
<div id="header-container">
    <div id="header">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <a class="brand" href="javascript:void(0);"><img width="75" height="50" src="{{asset('assets/admin/img/demo/logo-brand.png')}}"></a>
                    <!--
                    <div class="search-global">
                        <input id="globalSearch" class="search search-query input-medium" type="search">
                        <a class="search-button" href="javascript:void(0);"><i class="fontello-icon-search-5"></i></a>
                    </div>
                    -->
                    <div class="nav-collapse collapse">

                        <ul class="nav">
                            <li class="active"> <a href="{{URL::to('admin/')}}">Dashboard</a> </li>
                            <!--<li> <a href="">Orders</a> </li>-->
                            <li> <a href="{{URL::to('admin/users')}}"><span class="fontello-icon-users"></span>Users</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- // navbar -->

        <div class="header-drawer">
            <div class="mobile-nav text-center visible-phone"> <a href="javascript:void(0);" class="mobile-btn" data-toggle="collapse" data-target=".sidebar"><i class="aweso-icon-chevron-down"></i> Components</a> </div>
            <!-- // Resposive navigation -->
            <div class="breadcrumbs-nav hidden-phone">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{URL::to('admin/')}}"><i class="fontello-icon-home f12"></i> Dashboard</a></li>
                </ul>
            </div>
            <!-- // breadcrumbs -->
        </div>
        <!-- // drawer -->
    </div>
</div>
<!-- // header-container -->

<div id="main-container">
    <div id="main-sidebar" class="sidebar sidebar-inverse">
        <div class="filler"></div>
        <div class="sidebar-item">
            <div class="media profile">
                <div class="media-thumb media-left thumb-bordereb">
                    @if( !empty(Sentry::getUser()->avatar) )
                    <img class="thumb" src="{{asset('assets/admin/data/avatars')}}/{{ Sentry::getUser()->avatar }}">
                    @else
                    <img class="thumb" src="{{asset('assets/admin/img/demo/demo-avatar9606.jpg')}}">
                    @endif
                </div>
                <div class="media-body">
                    <h5 class="media-heading">{{ Sentry::getUser()->first_name }} <small>as Administrator</small></h5>
                    <p class="data">Last Access: {{ Sentry::getUser()->last_login }}</p>
                </div>
            </div>
        </div>
        <!-- // sidebar item - profile -->

        <ul id="mainSideMenu" class="nav nav-list nav-side">
            @include('admin.partials.menu')
        </ul>
        <!-- // sidebar menu -->

        <div class="sidebar-item"></div>
        <!-- // sidebar item -->

    </div>
    <!-- // sidebar -->

    <div id="main-content" class="main-content container-fluid">
        <div class="filler"></div>
        <!-- // page head -->

        <?php
        if ( !isset($content) || is_null($content) || empty($content) ){
            echo 'SomeThing WRONG !';
        }else{
            echo $content;
        }
        ?>

    </div>
    <!-- // main-content -->

</div>
<!-- // main-container  -->

<footer id="footer-fix">
    <div id="footer-sidebar" class="footer-sidebar">
        <div class="navbar">
            <div class="btn-toolbar"><a class="btn btn-glyph btn-link" href="javascript:void(0);"><i class="fontello-icon-up-open-1"></i></a></div>
        </div>
    </div>
    <!-- // footer sidebar -->

    <div id="footer-content" class="footer-content">
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <ul class="nav pull-left">
                    <li class="divider-vertical hidden-phone"></li>
                    <li><a id="btnToggleSidebar" class="btn-glyph fontello-icon-resize-full-2 tip hidden-phone" href="javascript:void(0);" title="show hide sidebar"></a></li>
                    <li class="divider-vertical hidden-phone"></li>
                    <li><a id="btnChangeSidebar" class="btn-glyph fontello-icon-login tip hidden-phone" href="javascript:void(0);" title="change sidebar position"></a></li>
                    <li class="divider-vertical"></li>
                    <li><a id="btnChangeSidebarColor" class="btn-glyph fontello-icon-palette tip" href="javascript:void(0);" title="change sidebar color"></a></li>
                    <li class="divider-vertical"></li>
                    <li><a class="fontello-icon-home-3" href="{{ URL::to('admin') }}"></a></li>
                    <li class="divider-vertical"></li>
                </ul>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li><a class="btn-glyph fontello-icon-cog-4 tip" target="_blank" href="http://vip4it.sa/" title="Contact Us"></a></li>
                    <li class="divider-vertical"></li>
                    <li><a id="btnLogout" class="btn-glyph fontello-icon-logout-1 tip" href="{{ URL::to('admin/signout') }}" title="logout"></a></li>
                    <li class="divider-vertical"></li>
                    <li><a id="btnScrollup" class="scrollup btn-glyph fontello-icon-up-open-1" href="javascript:void(0);"><span class="hidden-phone">Scroll</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- // footer content -->

</footer>
<!-- // footer-fix  -->

</div>
<!-- // page-container  -->

<div class="modal-container">
    <!-- modal-gallery is the modal dialog used for the image gallery -->
    <div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div class="modal-image"></div>
        </div>
        <div class="modal-footer"><a class="btn btn-glyph btn-navi text-gold modal-prev"><i class="fontello-icon-left-open-1"></i><span>Previous</span> </a><a class="btn btn-glyph btn-yellow modal-play modal-slideshow" data-slideshow="5000"><i class="fontello-icon-play"></i><span>Slideshow</span> </a><a class="btn btn-glyph btn-inverse text-gold modal-download tip-tc" target="_blank" title="Downloads this image"><i class="fontello-icon-download"></i><span>Download</span> </a><a class="btn btn-glyph btn-navi text-gold modal-next"><span>Next</span> <i class="fontello-icon-right-open-1"></i></a></div>
    </div>
</div>


<!-- Plugins Custom - Only example -->
<script type="text/javascript" src="{{asset('assets/admin/libs/google-code-prettify/js/prettify.js')}}"></script>

<!-- Plugins Custom - Content -->
<script src="{{asset('assets/admin/libs/bootstrap-jasny/js/bootstrap-fileupload.js')}}"></script>

<!-- Plugins Custom - Component -->

<!-- main js -->
<script type="text/javascript" src="{{asset('assets/admin/js/core.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/common.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/admin/js/form.js')}}"></script>


<!-- Only This Demo Page
<script type="text/javascript" src="{{asset('assets/admin/js/demo/demo-dashboard1.js')}}"></script>
 -->
<script>

    $(document).ready(function() {

        $('.fileupload').fileupload();

        <!-- check for login error flash var -->
        @if (Session::has('flash_error'))
        $.gritter.add({
            title: "Notice!",
            text: "{{ Session::get('flash_error') }}",
            sticky: !0,
            time: "",
            class_name: "my-sticky-class"});
        @endif

    });

</script>


</body>
</html>