@extends('emails/layouts/default')

@section('content')
<p>{{ $user->first_name }} مرحبا</p>

<p>نود اعلامك بأنه تم الاشتراك بنجاح وتم تفعيل حسابك , اهلا بك معنا</p>

<p>اطيب التحيات</p>

<p>ادارة الموقع</p>
@stop
