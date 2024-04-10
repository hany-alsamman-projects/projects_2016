@if(!Sentry::check())
<a href="{{ route('signup') }}"><img src="{{asset('assets/images/signup_btn.png')}}"></a>
<a href="{{ route('signin') }}"><img src="{{asset('assets/images/login_btn.png')}}"></a>
<div id="login_form">
    <h2>تسجيل الدخول</h2>
    <form method="post" action="{{ route('signin') }}" class="login_guide">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <input name="email" id="email" value="{{ Input::old('email') }}" style="width:140px" placeholder="اسم المستخدم" class="input" type="text">
        <input type="password" name="password" id="password" style="width:140px" placeholder="كلمة المرور" class="input">
        <button class="button glossy orange-gradient" type="submit">  دخول  </button>
    </form>
</div>
@else
<div id="login_form">
    <h2>اهلا بك  {{ Session::get('user_name') }} !</h2>
    <a href=""><img width="60" height="60" src="{{asset('assets/images/add_property.png')}}"></a>
    <a href=""><img width="60" height="60" src="{{asset('assets/images/show_all.png')}}"></a>
    <a href="{{ URL::to('account/profile') }}"><img width="60" height="60" src="{{asset('assets/images/profile.png')}}"></a>
</div>
<a href="{{ URL::to('auth/logout') }}" class="button glossy orange-gradient">  تسجيل خروج  </a>
@endif