@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
دخول المشتركين
@parent
@stop

{{-- Page content --}}
@section('content')

    <form method="post" action="{{ route('signin') }}" style="direction: rtl" class="block wizard same-height">

        <h3 class="block-title silver-gradient glossy">تسجيل دخول</h3>

        <fieldset class="wizard-fieldset fields-list">

            <legend class="legend">معلومات الحساب</legend>

            <div class="field-block">
                <h4>اهلا بك !</h4>
                <p>الرجاء ادخال معلومات الحساب الخاص بك للدخول</p>
            </div>

            <div class="control-group{{ $errors->first('email', ' error') }} field-block button-height">
                <label for="first_name" class="label"><b>البريد الالكتروني</b></label>
                <input type="text" name="email" id="email" value="{{ Input::old('email') }}" class="input validate[required]">
                {{ $errors->first('email', '<span class="red-bg">:message</span>') }}
            </div>

            <div class="field-block button-height control-group{{ $errors->first('password', 'error') }}">
                <label for="last_name" class="label"><b>كلمة السر</b></label>
                <input type="password" name="password" id="password" class="input validate[required]">
                {{ $errors->first('password', '<span class="red-bg">:message</span>') }}
            </div>

            <div class="field-block button-height">
                <input type="checkbox" name="remember-me" id="remember-me" class="switch wide" checked data-text-on="تذكرني" data-text-off="لا">
            </div>

            <div class="field-block button-height wizard-controls align-right">

                <label class="label"><b><a href="{{ route('forgot-password') }}" class="">هل نسيت كلمة السر ؟</a></b></label>

                <button type="submit" class="button glossy mid-margin-left">
                    <span class="button-icon"><span class="icon-tick"></span></span>
                    دخول
                </button>

                <a href="{{ URL::to('oauth/facebook/authorize/?redirect=/auth/fb/signup') }}"  class="button">
                <span class="button-icon"><span class="icon-facebook"></span></span>
                الدخول بحساب فيسبوك
                </a>

            </div>

        </fieldset>
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    </form>

@stop