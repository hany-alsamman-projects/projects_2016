<form action="{{URL::route('search')}}" method="post">

    @if(Request::ajax())
    <div style="margin-right: 50px">
        <h2>لا يوجد نتائج للبحث الذي قمت به, يمكنك البحث مجددا في مناطق اخرى</h2>
    </div>
    @endif

    <!-- CSRF Token -->
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />


    <div class="flt-r mid-margin-left">
        <div class="label">
            <img style="height: 120px" src="{{ URL::asset('assets/images/MapMarker.png') }}" alt="">
        </div>
    </div>


    <div class="g2 flt-r mid-margin-left">

        <div class="label"><span>اختر البلد</span></span></div>
        {{ Form::select('country_id', $country_id, null, array('class' => 'select full-width', 'id' => 'country_id')) }}

        <div class="label"><span>نوع العقار</span></div>
        {{ Form::select('type_id', $type_id, null, array('class' => 'select full-width', 'id' => 'type_id')) }}


    </div>
    <div class="g2 flt-r mid-margin-left">

        <div class="label"><span>اختر المدينة</span></span></div>
        {{ Form::select('city_id', $city_id, null, array('class' => 'select full-width', 'id' => 'city_id')) }}

        <div class="label"><span>نوع العملية</span></div>
        {{ Form::select('section_id', $section_id, null, array('class' => 'select full-width', 'id' => 'section_id')) }}
    </div>

    <div class="g2 flt-r">

        <div class="label"><span>اقل سعر</span></span></div>
        <select style="width: 150px;" name="price_rang_min" class="select">
            <option value="any">غير محدد</option>
            <option value="100000">100,000</option><option value="250000">250,000</option><option value="500000">500,000</option><option value="750000">750,000</option><option value="1000000">1,000,000</option><option value="2000000">2,000,000</option><option value="5000000">5,000,000</option>
        </select>

        <div class="label"><span>اعلى سعر</span></span></div>
        <select style="width: 150px;" name="price_rang_max" class="select">
            <option value="any">غير محدد</option>
            <option value="100000">100,000</option><option value="250000">250,000</option><option value="500000">500,000</option><option value="750000">750,000</option><option value="1000000">1,000,000</option><option value="2000000">2,000,000</option><option value="5000000">5,000,000</option>
        </select>
    </div>

    <div class="g1 flt-r black-inputs">
        <div class="label"><span>بالصورة</span></div>
        <input type="radio" name="search_type" id="search_type" checked="true" value="photos" class="switch tiny">

        <p>&nbsp;</p>

        <div class="label"><span>بالفيديو</span></div>
        <input type="radio" name="search_type" id="search_type" value="videos" class="switch tiny">
    </div>

    <div style="margin-top: 60px" class="flt-r">
        <button class="button huge orange-gradient" type="submit">ابحث</button>
    </div>

</form>