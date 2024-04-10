
<div class="property_images">
@if(!empty($property_thumb))
<img id="hany_magic" style="cursor: pointer" src="{{ URL::asset($property_thumb) }}" alt="">
@else
<img id="hany_magic" src="{{ URL::asset('assets/images/no_thumbnail.png') }}" alt="">
@endif
</div>

<script>
    $(document).ready(function(){

        var winWidth = $(window).width();
        thumbs = (winWidth > 767) ? true : false;

        @if(!empty($property_images))
            $('#hany_magic').click(function(){
            $.iLightBox(
                [
                    @foreach($property_images as $images)
                            {
                                URL: "{{ URL::asset($images_path.$images) }}",
                                    options: {
                                thumbnail: "{{URL::asset(Image::open(URL::asset($images_path.$images))->forceResize(200)) }}"
                            },
                                type: "image"
                            },
                    @endforeach
                ],
                {
                    skin: 'dark',
                    path: 'horizontal',
                    controls: {
                        thumbnail: thumbs
                    },
                    overlay: {
                        opacity: .7,
                        blur: false
                    },
                    styles: {
                        nextOpacity: .55,
                        prevOpacity: .55
                    },
                    effects: {
                        switchSpeed: 700
                    },
                    overlay: {
                        opacity: 0.7
                    }
                }
            );
            return false;
        });
        @endif

        $('#video_gallery').click(function(){
            $.iLightBox(
                [
                    @if(isset($property->videos))
                        @foreach (unserialize($property->videos) as $link)
                            { URL: "{{$link}}" },
                        @endforeach
                    @endif
                ],
                {
                    smartRecognition: true,
                    skin: 'mac',
                    overlay: {
                        blur: false
                    },
                    keyboard: {
                        esc: false
                    },
                    styles: {
                        nextOpacity: .55,
                        prevOpacity: .55
                    }
                }
            );
            return false;
        });

    });

</script>
