<div class="content" role="main" id="content">

    <div id="breadcrumbs">
        <ul class="breadcrumbs">
            <li class="front_page"><a href="#">Home</a></li><li class="current"><span>&gt;</span> {{ $DeptID->title }}</li><span>&gt;</span> {{ $product->title }}</li></ul>
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

    <div class="site-content" id="primary">

        <div class="clear"></div>
        <div id="page_children">

            @if(!$product)

            No record found

            @else

            <div class="child">
                <div class="child-content">
                    <img width="268" height="201" src='{{asset("assets/data/covers/$product->photo")}}'>
                    <h2 class="child-title red"><a href="#">{{ $product->title }}</a></h2>
                    <p class="child-excerpt gray">
                        {{ $product->content }}
                    </p>
                </div>
            </div>
            <div class="clear"></div>

            @endif
        </div> <!--end children-->

    </div><!-- #primary -->
    <div class="clear"></div>
</div>