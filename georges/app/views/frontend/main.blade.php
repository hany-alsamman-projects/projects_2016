<div id="wrapper" class="container">
    <div class="row">
        <div class="col-sm-8">

            <!-- Three columns of text below the carousel -->
            <div id="sections" class="row text-center">
                <div class="col-md-4">
						<span class="fa-stack fa-5x">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-eye fa-stack-1x fa-inverse"></i>
						</span>
                    <h2>Virtual Tour</h2>
                    <p class="text-muted">Feel the village, take a tour.</p>
                    <hr>
                    <p><a class="btn btn-success" href="{{ URL::to('/page/virtual-tour') }}" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->

                <div class="col-md-4">
						<span class="fa-stack fa-5x">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-users fa-stack-1x fa-inverse"></i>
						</span>
                    <h2>Residents</h2>
                    <p class="text-muted">Residents area.</p>
                    <hr>
                    <p><a class="btn btn-success" href="{{ route('account') }}" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->

                <div class="col-md-4">
						<span class="fa-stack fa-5x">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-comment-o fa-stack-1x fa-inverse"></i>
						</span>
                    <h2>Testimonials</h2>
                    <p class="text-muted">What they said?</p>
                    <hr>
                    <p><a class="btn btn-success" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->

            </div><!-- /.row -->
        </div><!--/.col-sm-8 -->

        @include('frontend/layouts/widget')

    </div><!--/.row -->
</div>

<div id="content" class="container">
    <div class="row">

        <div class="col-sm-8">
            <div class="panel panel-new">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-exclamation-circle"></i> About us</h3>
                </div>
                <div class="panel-body">

                    {{ Page::where('static', 1)->where('slug', 'home')->first()->content }}

                    <hr>
                    <a href="#" class="btn btn-success">Read more</a>
                </div>
            </div>
        </div><!--/.col-sm-8 -->

        @include('frontend/layouts/side')

    </div><!--/.row -->
</div>