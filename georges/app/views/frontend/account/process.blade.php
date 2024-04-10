@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')

@stop

{{-- Account page content --}}
@section('content')
<div id="content" class="container">
    <div class="row">

        <div class="col-sm-12">
            <div class="panel panel-new">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-exclamation-circle"></i> Dear Sir,
                        @if(Sentry::check())
                        {{ Sentry::getUser()->first_name }}
                        @endif
                    </h3>
                </div>
                <div class="panel-body">
                    We've Got Your Request now ! ,  we will reply it ASAP

                </div>
            </div>
        </div><!--/.col-sm-8 -->
    </div><!--/.row -->
</div>
@stop