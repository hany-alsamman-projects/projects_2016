@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
دخول المشتركين
@parent
@stop

{{-- Page content --}}
@section('content')

<form method="post" action="{{ route('signup') }}" autocomplete="off" style="direction: rtl" class="block wizard same-height">

    <h3 class="block-title silver-gradient glossy">اشتراك</h3>

    <fieldset class="wizard-fieldset fields-list">

        <legend class="legend">معلومات الحساب</legend>

        <div class="field-block">
            <h4>اهلا بك </h4>
            <p>يمكنك الاشتراك معنا الآن مجانا !</p>
        </div>

        <div class="field-block button-height">
            <label for="first_name" class="label"><b>الاسم</b></label>
            <input type="text" name="first_name" id="first_name" class="input validate[required]" value="{{ Input::old('first_name') }}" />
            {{ $errors->first('first_name', '<span class="red-bg">:message</span>') }}
        </div>

        <div class="field-block button-height">
            <label for="email" class="label"><b>البريد الالكتروني</b></label>
            <input type="text" name="email" id="email" class="input validate[required]" value="{{ Input::old('email') }}" />
            {{ $errors->first('email', '<span class="red-bg">:message</span>') }}
        </div>

        <div class="field-block button-height">
            <label for="last_name" class="label"><b>كلمة السر</b></label>
            <input type="password" name="password" id="password" class="input validate[required]">
            {{ $errors->first('password', '<span class="red-bg">:message</span>') }}
        </div>

        <div class="field-block button-height">
            <label for="last_name" class="label"><b>تأكيد كلمة السر</b></label>
            <input type="password" name="password_confirm" id="password_confirm" class="input validate[required]">
            {{ $errors->first('password_confirm', '<span class="red-bg">:message</span>') }}
        </div>

        <div class="field-block button-height">
            <label for="phone_number" class="label"><b>رقم الجوال</b></label>
            <span class="input">
                <label for="pseudo-input-2" class="button orange-gradient">
                    <span class="icon-phone small-margin-right"></span>
                </label>
               <input type="text" name="phone_number" id="pseudo-input-1" class="input-unstyled input-sep" placeholder="الرقم" value="" style="width: 100px;">
               <input type="text" name="phone_area" id="pseudo-input-2" class="input-unstyled " placeholder="مفتاح" value="" maxlength="3" style="width: 35px;">
            </span>
            {{ $errors->first('phone_number', '<span class="red-bg">:message</span>') }}
        </div>

        <div class="field-block button-height">
            <label for="last_name" class="label"><b>نوع الحساب</b></label>
            {{ Form::select('group_id', $groups, null, array('class' => 'select', 'id' => 'groups')) }}
        </div>

        <div class="field-block button-height">
            <label for="last_name" class="label"><b>البلد</b></label>
            {{ Form::select('countries', $countries, null, array('class' => 'select', 'id' => 'countries')) }}
        </div>

        <div class="field-block button-height wizard-controls align-right">
            <button type="submit" class="button glossy mid-margin-left">
                <span class="button-icon"><span class="icon-tick"></span></span>
                تسجيل
            </button>
        </div>

    </fieldset>
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

</form>

<script type="text/javascript">
    jQuery(document).ready(function() {

    });
</script>
@stop