<link rel="stylesheet" type="text/css" media="all" href="{{asset('assets/js/gallery/css/font-awesome.min.css')}}" />
<link rel="stylesheet" type="text/css" media="all" href="{{asset('assets/js/gallery/css/jgallery.min.css?v=1.3.0')}}" />

<script type="text/javascript" src="{{asset('assets/js/gallery/js/tinycolor-0.9.16.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/gallery/js/jgallery.min.js?v=1.3.0')}}"></script>

<script type="text/javascript">
    $( function() {
        $( '#gallery' ).jGallery( {
            'autostart': false,
            'canClose': true
        } );
    } );
</script>

<div id="gallery">
    <div class="album" data-jgallery-album-title="Album 1">
        <h1>Album 1</h1>

        @foreach(range(1,20) as $num)
        @if( file_exists('assets/images/photos/'.$num.'.jpg') )
        <a href="{{URL::asset(Image::open(URL::asset('assets/images/photos/'.$num.'.jpg'))->forceResize(800,600)) }}">
        <img src="{{URL::asset(Image::open(URL::asset('assets/images/photos/'.$num.'.jpg'))->forceResize(120,80)) }}" alt=""  data-jgallery-bg-color="#3e3e3e" data-jgallery-text-color="#fff" /></a>
        @endif
        @endforeach

    </div>
    <div class="album" data-jgallery-album-title="Album 2">
        <h1>Album 2</h1>

        @foreach(range(21,50) as $num)
        @if( file_exists('assets/images/photos/'.$num.'.jpg') )
        <a href="{{URL::asset(Image::open(URL::asset('assets/images/photos/'.$num.'.jpg'))->forceResize(800,600)) }}">
        <img src="{{URL::asset(Image::open(URL::asset('assets/images/photos/'.$num.'.jpg'))->forceResize(120,80)) }}" alt=""  data-jgallery-bg-color="#3e3e3e" data-jgallery-text-color="#fff" /></a>
        @endif
        @endforeach
    </div>
</div>
