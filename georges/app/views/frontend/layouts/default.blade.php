<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="hany alsamman <hany.alsamman@gmail.com>">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>Georges Andraos</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/bootstrap.min.css')}}
    {{ HTML::style('assets/css/bootstrap-theme.min.css')}}
    {{ HTML::style('assets/css/hamra-theme.css')}}
    {{ HTML::style('assets/css/font-awesome.min.css')}}
    {{ HTML::style('assets/css/screen.css')}}
    {{ HTML::style('assets/css/datepicker.css')}}

    <!-- Custom styles for this template -->
    {{ HTML::style('assets/css/base.css')}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

@include('frontend/layouts/header')

@yield('content')


<!-- JavaScript Placed at the end of the document so the pages load faster -->
<script src="{{asset('assets/js/jquery-2.1.0.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap-validation.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/holder.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/website.js')}}" type="text/javascript"></script>
</body>
</html>