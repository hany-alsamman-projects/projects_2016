<div class="col-sm-4">
    <div class="panel panel-new">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-picture-o"></i> Photo Gallery</h3>
        </div>
        <div class="panel-body text-center">
            <div class="row">
                <div class="col-md-12">
                    @foreach(range(1,6) as $num)
                    <a href="{{ URL::to('/page/gallery') }}"><img style="width: 110px; height: 115px" src="{{asset("assets/images/photos/$num.jpg")}}"></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div><!--/.col-sm-4 -->