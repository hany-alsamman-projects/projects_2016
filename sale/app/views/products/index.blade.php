<div class="content" role="main" id="content">

    <div id="breadcrumbs">
        <ul class="breadcrumbs">
            <li class="front_page"><a href="#">Home</a></li><li class="current"><span>&gt;</span> {{ $DeptID->title }}</li></ul>
    </div>
    <div id="page-content">
        <!--

        <h1 class="entry-title">Inks, Coatings and Pressroom Products</h1>

        <div class="entry-content">
            <p>Chemical offers a broad ink and coating product portfolio with a wide range of capabilities that include flexographic packaging inks, energy-curable inks and coatings, label and narrow web inks, specialty coatings, color software and brand color management.</p>
        </div>

        <div class="comments-area" id="comments">

        </div>#comments .comments-area -->
    </div>

    <div class="site-content floatLeft" id="primary">

        <div class="clear"></div>
        <div id="page_children">

            @if($products->isEmpty())

            No record found

            @else

            <h2>{{ $DeptID->title }}</h2>

            <br>

            @foreach($products as $product)
            <div class="child">
                <div class="child-content">
                    <div class="news_circle blue_circle" style="background-image: url({{asset("upload/covers/$product->photo")}})"></div>
                    <div  class="child-title"><h2><a href="{{ URL::to("en/news/view/$product->id")}}">{{ $product->title }}</a></h2></div>
                    <p class="child-excerpt gray">
                        {{ Str::limit($product->content, 400) }}
                    </p>
                    <a href="{{ URL::to("en/news/view/$product->id")}}">More<!----><span class="arrow_span">»</span><!----></a>
                </div>
            </div>
            <div class="clear"></div>
            @endforeach

            <?php echo $products->links(); ?>

            @endif
        </div> <!--end children-->

    </div><!-- #primary -->
    <div class="clear"></div>
</div>