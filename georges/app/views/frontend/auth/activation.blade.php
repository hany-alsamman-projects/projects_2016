@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
<div id="content" class="container">
    <div class="row">

        <div class="col-sm-8">
            <div class="panel panel-new">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-exclamation-circle"></i> {{ Page::where('static', 1)->where('slug', 'policy')->first()->description }}</h3>
                </div>
                <div class="panel-body">
                    {{ Page::where('static', 1)->where('slug', 'policy')->first()->content }}
                    <hr>
                    <a href="activation/?agree={{Str::random(32)}}" class="btn btn-success">I agree , Continue</a>
                </div>
            </div>
        </div><!--/.col-sm-8 -->

        @include('frontend/layouts/side')

    </div><!--/.row -->
</div>
@stop