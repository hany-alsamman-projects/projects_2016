<form action="{{URL::route('alerts_follow')}}" method="post">
    <!-- CSRF Token -->
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />

    {{ Form::select('country_id', $country_id, null, array('class' => 'select fixedWidth','style' => 'min-width:70px', 'id' => 'country_id')) }}

    {{ Form::select('city_id', $city_id, null, array('class' => 'select','style' => 'min-width:150px', 'id' => 'city_id')) }}

    {{ Form::select('type_id', $type_id, null, array('class' => 'select','style' => 'min-width:130px', 'id' => 'type_id')) }}

    {{ Form::select('section_id', $section_id, null, array('class' => 'select','style' => 'min-width:100px', 'id' => 'section_id')) }}

    @if(!Sentry::check())
    <input style="width:150px; height: 19px;" name="user_email" placeholder="البريد الإلكتروني" class="input" type="text">
    @endif

    @if(!HomeController::alerts_exists())
    <button class="button glossy orange-gradient" type="submit">اشترك</button>
    @else
    <button class="button glossy green-gradient disabled" disabled type="submit">انت مشترك فعلا!</button>
    @endif


</form>