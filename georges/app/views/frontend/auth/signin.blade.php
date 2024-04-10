@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Resident auth
@parent
@stop

{{-- Page content --}}
@section('content')

<div id="wrapper" class="container">
    <div class="row">
        <div class="col-sm-8">
            <!-- Three columns of text below the carousel -->
            <div id="login" class="row">
                <div class="panel panel-new col-md-8">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-sign-in"></i> Resident Area</h3>
                    </div>
                    <form method="post" action="{{ route('signin') }}" role="form">
                        <br>
                        <div class="form-group {{ $errors->first('email', ' error') }}">
                            <label for="first_name"><i class="fa fa-user"></i><b> Username</b></label>
                            <input type="text" name="email" id="email" value="{{ Input::old('email') }}" placeholder="Username" class="form-control required">
                            {{ $errors->first('email', '<span class="red-bg">:message</span>') }}
                        </div>

                        <div class="form-group {{ $errors->first('email', ' error') }}">
                            <label for="password"><i class="fa fa-lock"></i> Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            {{ $errors->first('password', '<span class="red-bg">:message</span>') }}
                        </div>

                        <hr>

                        <button type="submit" class="btn btn-primary">Login</button>

                        <a href="{{ route('forgot-password') }}" class="btn btn-link">Forgot your password?</a>

                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </form>
                </div><!-- /.col-lg-6 -->
                <!--
                <div class="col-md-6">
                    <div class="page-header">
                        <h3>New Resident?</h3>
                    </div>
                    <p>If you don't have an account yet, please sign up for a new account by clicking on the following link.</p>
                    <hr>
                    <a href="#" class="btn btn-success btn-lg">Create new account</a>

                </div>
                -->
            </div><!-- /.row -->
        </div><!--/.col-sm-8 -->

    </div><!--/.row -->
</div>


@stop