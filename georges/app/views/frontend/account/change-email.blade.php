@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
<i class="fa fa-user"></i> Change your Email
@stop

{{-- Account page content --}}
@section('account-content')

<!-- check for login error flash var -->
@if (Session::has('success'))
<div class="panel-body">
    <div class="alert alert-success">
        <strong>{{ Session::get('success') }}</strong>
    </div>
</div>

@endif
<form method="post" action="" class="form-horizontal  col-md-8" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Form type -->
	<input type="hidden" name="formType" value="change-email" />

	<!-- New Email -->
	<div class="control-group{{ $errors->first('email', ' error') }}">
		<label class="control-label" for="email">New Email</label>
		<div class="controls">
			<input type="text" name="email" class="form-control" id="email" value="" required/>
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Confirm New Email -->
	<div class="control-group{{ $errors->first('email_confirm', ' error') }}">
		<label class="control-label" for="email_confirm">Confirm New Email</label>
		<div class="controls">
			<input type="text" class="form-control" name="email_confirm" id="email_confirm" value="" data-validation-matches-match="email"  data-validation-matches-message=  "Must match email address entered above"/>
			{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Current Password -->
	<div class="control-group{{ $errors->first('current_password', ' error') }}">
		<label class="control-label" for="current_password">Current Password</label>
		<div class="controls">
			<input type="password" class="form-control" name="current_password" id="current_password" value="" />
			{{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<hr>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">Update Email</button>

			<a href="{{ route('forgot-password') }}" class="btn btn-default">I forgot my password</a>
		</div>
	</div>
</form>
@stop
