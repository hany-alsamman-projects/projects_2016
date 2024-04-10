<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
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

    <!-- Custom styles -->
    <style type="text/css">
        .signin-content {
            max-width: 360px;
            margin: 80px auto 20px;
        }
    </style>

    <!-- Le styles -->
    {{ HTML::style('assets/admin/css/bootstrap.css') }}
    {{ HTML::style('assets/admin/css/bootstrap-responsive.css') }}
    {{ HTML::style('assets/admin/css/extension.css') }}
    {{ HTML::style('assets/admin/css/main.css') }}
    {{ HTML::style('assets/admin/css/style.css') }}

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/selectivizr/selectivizr.js')}}"></script>
    <script src="{{asset('assets/admin/libs/pl-visualization/excanvas/js/excanvas.js')}}"></script>
    <![endif]-->

    <script src="{{asset('assets/admin/libs/modernizr/modernizr-2.6.2/js/modernizr-2.6.2.js')}}"></script>

    <!-- Libraries -->
    <script src="{{asset('assets/admin/libs/jquery/jquery-1.9.1/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/libs/pl-system-info/gritter/js/jquery.gritter.min.js')}}"></script>
</head>

<body class="signin signin-vertical">
<div class="page-container">
    <div id="header-container">
        <div id="header">
            <div class="navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container"> </div>
                </div>
            </div>
            <!-- // navbar -->

            <div class="header-drawer" style="height:3px"> </div>
            <!-- // breadcrumbs -->
        </div>
        <!-- // drawer -->
    </div>
    <!-- // header-container -->

    <div id="main-container">
        <div id="main-content" class="main-content container">
            <div class="signin-content">
                <h1 class="welcome text-center" style="line-height: 0.6;">
                    <img src="{{asset('assets/admin/img/demo/logo-brand.png')}}">
                </h1>
                <div class="well well-black well-impressed">
                    <div class="tab-content overflow">
                        <div class="tab-pane fade in active" id="login">
                            <h3 class="no-margin-top"><i class="fontello-icon-user-4"></i> Sign in with your ID</h3>
                            <form class="form-tied margin-00" method="post"  action="{{ route('login') }}" name="login_form">
                                <fieldset>
                                    <legend class="two"><span>Legend</span></legend>
                                    <ul>
                                        <li>
                                            <input type="email" class="input-block-level" name="email" value="{{ Input::old('email') }}" placeholder="User Name" autocomplete="off">
                                        </li>
                                        <li>
                                            <input type="password" name="password" class="input-block-level" value="" placeholder="Password" autocomplete="off">
                                        </li>
                                    </ul>
                                    <button type="submit" class="btn btn-yellow btn-block btn-large">SIGN IN</button>
                                    <hr class="margin-xm">
                                    {{ $errors->first('email', ' <p class="message">
                                        :message<span class="close show-on-parent-hover">✕</span>
                                    </p>') }}

                                    {{ $errors->first('password', ' <p class="message">
                                        :message<span class="close show-on-parent-hover">✕</span>
                                    </p>') }}
                                    <!--
                                        <label class="checkbox pull-left">
                                        <input id="remember" class="checkbox" type="checkbox">
                                        Remember me </label>
                                        -->
                                </fieldset>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            </form>
                            <!-- // form -->

                        </div>
                        <!-- // Tab Login -->

                    </div>
                </div>
                <!-- // Well-Black -->
                <div class="web-description">
                    <h5>Copyright &copy; 2014 {{ Config::get('settings.site.title') }}</h5>
                    <p>All rights reserved for the benefit of <a href="http://vip4it.com" target="_blank"><strong>Virtual Integrated Projects</strong></a> ©&nbsp;</p>
                </div>
            </div>
            <!-- // sign-content -->

        </div>
        <!-- // main-content -->

    </div>
    <!-- // main-container  -->

</div>
<!-- // page-container -->


<script>
    $(document).ready(function() {

        <!-- check for login error flash var -->
        @if (Session::has('flash_error'))
            $.gritter.add({
                title: "Warning!",
                text: "{{ Session::get('flash_error') }}",
                sticky: !0,
                time: "",
                class_name: "my-sticky-class"});
        @else
            $.gritter.add({
                title: "Welcome!",
                text: "Please login to access CMS!",
                sticky: !0,
                time: "",
                class_name: "my-sticky-class"});
        @endif

    });

</script>
</body>
</html>