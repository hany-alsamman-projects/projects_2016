@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Forgot Password ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div id="wrapper" class="container">
    <div class="row">
        <div class="col-sm-8">
            <!-- Three columns of text below the carousel -->
            <div id="login" class="row">
                <div class="col-md-8">
                    <div class="page-header">
                        <h3>Forgot password</h3>
                    </div>

                    <form method="post" action="" role="form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <!-- Email -->
                        <div class="form-group {{ $errors->first('email', ' error') }}">
                            <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input type="text"  class="form-control" name="email" id="email" value="{{ Input::old('email') }}" />
                                {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="controls">
                                <a class="btn btn-warning" href="{{ route('home') }}">Cancel</a>

                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('frontend/layouts/widget')
    </div>
</div>
@stop
