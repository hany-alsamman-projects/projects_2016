@extends('frontend/layouts/default')

@section('title')
{{ $property->type_id }} {{ $property->section_id }} :: {{ $property->title }}
@parent
@stop

{{-- Page content --}}
@section('content')


<div class="block large-margin-top margin-bottom">

    <h3 class="block-title">{{ $property->type_id }} {{ $property->section_id }} :: {{ $property->title }}</h3>

    <div class="with-padding">

        <div style="width: 35%; float: left">
            <div class="property_map">
                {{ $map_div }}

                <div style="height: 50px" class="clear-both with-padding">

                    <p class="white">
                        @if(isset($property->videos))
                        <a style="float:right" class="white" href="#" id="video_gallery"><img style="height: 75px; float:right" src="{{ URL::asset('assets/images/video.png') }}" ></a>

                        @else
                        <img style="height: 75px; float:right" src="{{ URL::asset('assets/images/MapMarker.png') }}" >
                        @endif
                        <br>
                        <span>رقم الإعلان: {{ $property->id }}  </span>
                        <br>
                        <span>تمت الاضافة بتاريخ : {{ $property->added_on }}</span>
                        <br>
                    </p>

                </div>
            </div>
            @include('frontend/property/slider')
        </div>

    </div>

    <div class="property_box">

        <div class="property_title">
            <h2>{{ $property_price }} السعر</h2>
            @if($property->section_id == 'للبيع')
            <span>سعر المتر² = {{ $property_meter_price }}</span>
            @endif
        </div>
        <table cellspacing='0'>

            <thead class="orange-gradient">
            <tr>
                <th colspan="2">عنوان العقار : {{ $property->address }}</th>
            </tr>
            </thead>

            <tbody>

            <tr>
                <td>النوع</td>
                <td>{{ $property->type_id }} {{ $property->section_id }}</td>
            </tr><!-- Table Row -->

            <tr class="even">
                <td>الطابق</td>
                <td>{{ $property->floor_number }} </td>
            </tr>

            <tr>
                <td>الغرف</td>
                <td>{{ $property->rooms }}</td>
            </tr>

            <tr class="even">
                <td>الحمامات</td>
                <td>{{ $property->bathrooms }}</td>
            </tr>

            <tr>
                <td>المساحة</td>
                <td>{{ $property->floor_area }} متر</td>
            </tr>

            <tr class="even">
                <td>سنة البناء</td>
                <td>{{ $property->year_built }}</td>
            </tr>

            <tr>
                <td>التشطيب</td>
                <td>{{ $property->finishing }}</td>
            </tr>
            </tbody>
        </table>

        <div style="position: relative; float: left; text-align: left; direction: ltr; clear: both">
            <span class='st_fblike_large' displayText='Facebook Like'></span>
            <span class='st_fbsend_large' displayText='Facebook Send'></span>
            <span class='st_facebook_large' displayText='Facebook'></span>
            <span class='st_twitter_large' displayText='Tweet'></span>
            <span class='st_linkedin_large' displayText='LinkedIn'></span>
            <span class='st_googleplus_large' displayText='Google +'></span>
            <span class='st_google_bmarks_large' displayText='Bookmarks'></span>
            <span class='st_email_large' displayText='Email'></span>

            <script type="text/javascript">var switchTo5x=true;</script>
            <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

            <script type="text/javascript">stLight.options({publisher: "22b28415-0497-47d4-bd55-45fec90f3b3e", theme:7, doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
        </div>
    </div>

    <div class="with-padding" style="position: relative; clear: both">

        <div id="disqus_thread"></div>
        <script type="text/javascript">
            var disqus_shortname = 'mapkom';

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

        </div>

</div>


<div id="special_projects" style="text-align: center">
    <div>
        <img src="{{asset('assets/images/featured_btn.jpg')}}" />
    </div>
    <div class="project_contents">
        @foreach($featured_property as $property)
        <div class="project_box">
            <div class="project_image">
                <img src="{{URL::asset(Image::open(URL::asset('upload/'.$property->id.'/'.$property->property_file))->forceResize(180,140)) }}">
            </div>
            <div class="project_title">{{ Str::limit($property->title, 60); }}</div>
            <div class="project_info">
                <span>الزيارات: {{$property->viewed}}</span>

                <a class="button orange-gradient" href="{{URL::asset('property/'.$property->id)}}">
                    معلومات اكثر
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{ $map_js_render }}

@stop
