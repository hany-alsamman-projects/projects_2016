@extends('emails/layouts/default')

@section('content')
<p>{{ $user->first_name }} مرحبا</p>

<p>اهلا بك معنا , نود اعلامك ان حسابك جاهز للاستخدام وباقي خطوة واحد فقط لتستطيع التفاعل معنا</p>

<p>
    نرجو الضغط على الرابط التالي لتفعيل الحساب
    <a href="{{ $activationUrl }}">{{ $activationUrl }}</a>
</p>

<p>اطيب التحيات</p>

<p>ادارة الموقع</p>
@stop
