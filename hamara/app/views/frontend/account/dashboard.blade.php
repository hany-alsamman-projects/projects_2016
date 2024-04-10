@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
<div id="content" class="container">
    <div class="row">

        <div class="col-sm-8">
            <div class="panel panel-new">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-cog"></i> Dashboard</h3>
                </div>
                <div class="panel-body">
                    <!-- Three columns of text below the carousel -->
                    <div id="dashboard" class="text-center">

                        @foreach($board as $item)
                        <div class="col-md-4">
                            <a class="btn btn-link" href="{{ URL::to("page/$item->slug") }}" role="button">
								<span class="fa-stack fa-3x">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-list-alt fa-stack-1x fa-inverse"></i>
								</span>
                                <br>
                                <p>{{ Controllers\Account\DashboardController::ucname($item->slug) }}</p>
                            </a>
                        </div>
                        @endforeach

                    </div><!-- /.row -->

                </div>
            </div>
        </div><!--/.col-sm-8 -->

        <div class="col-sm-4">
            <div class="panel panel-new">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user"></i> Account</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ URL::route('account') }}">Dashboard</a></li>
                        <li class="list-group-item"><a href="{{ URL::route('profile') }}">Profile</a></li>
                        <li class="list-group-item"><a href="{{ URL::route('change-password') }}">Change Password</a></li>
                        <li class="list-group-item"><a href="{{ URL::route('change-email') }}">Change Email</a></li
                    </ul>
                </div>

            </div>
        </div><!--/.col-sm-4 -->

    </div><!--/.row -->
</div>
@stop
