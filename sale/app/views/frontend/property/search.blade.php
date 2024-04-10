@extends('frontend/layouts/default')

@section('title')
    @if(is_array($monster) && count($monster) > 0)
عقارات  {{ $monster[0]->section_slug }}
    @endif
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="project_contents">
    @if(!empty($monster))

    @foreach($monster as $property)
    <div class="project_box">
        <div class="project_image">
            <img src="{{URL::asset(Image::open(URL::asset('upload/'.$property->id.'/'.$property->property_file))->forceResize(180,140)) }}">
        </div>
        <div class="project_title">{{ Str::limit($property->title, 60); }}</div>
        <div class="project_info">
            <span>الزيارات: {{$property->viewed}}</span>

            <a class="button silver-gradient" href="{{URL::asset('property/'.$property->id)}}">
                معلومات اكثر
            </a>
        </div>
    </div>
    @endforeach

    @else

    @section('title')
         لا يوجد نتائج مطابقة للبحث
    @parent
    @stop

    <div class="white black-gradient">
        <img style="vertical-align: middle;" src="{{asset('assets/images/standard/icon_error.png')}}" > <span class="label">لا يوجد نتائج مطابقة للبحث</span>
    </div>

    <script>

        jQuery(document).ready(function() {

            $.iLightBox([
                {
                    URL: '{{ URL::to("search_bar") }}',
                    type: 'ajax',
                    options: {
                        onRender: function(api){
                            $(api.element)
                            .wrap(function() {
                                return '<div class="inline_search_bar">'+ $(api.element).contents +'</div>';
                            });
                        },
                        width: 800,
                        height: 200
                    }
                }
            ],
                {
                    innerToolbar: true,
                    controls: {
                        fullscreen: false
                    },
                    skin: 'parade',
                    minScale: 1
                });

        });
    </script>

    @endif
</div>

@stop

