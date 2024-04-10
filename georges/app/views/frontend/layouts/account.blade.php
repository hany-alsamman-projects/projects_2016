@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')

<div id="content" class="container">
    <div class="row">

        <div class="col-sm-12">
            <div class="panel panel-new">
                <div class="panel-heading">
                    <h3 class="panel-title">@yield('title')</h3>
                </div>
                <div class="panel-body">
                    @yield('account-content')
                </div>
            </div>
        </div><!--/.col-sm-8 -->
    </div><!--/.row -->
</div>
@stop
