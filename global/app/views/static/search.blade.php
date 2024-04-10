<section id="contents">
    <div class="container">

        <div class="block_head sixteen columns">
            <h1><strong>Search Results</strong></h1>
        </div>

        <div class="portfolio sixteen columns">
            @foreach($matched as $page)
            <h4>{{$page->title}}</h4>
            <p>{{Str::limit(strip_tags($page->content), 250)}}</p>
            <p><a href="{{URL::to("".Request::segment(1)."/page/$page->slug")}}">Read More</a></p>
            <hr/>
            @endforeach
        </div>
    </div>
</section>