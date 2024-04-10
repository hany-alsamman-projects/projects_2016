<!-- Slider -->
<div class="container">
    <div id="slider" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#slider" data-slide-to="0" class="active"></li>
            <li data-target="#slider" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="{{asset('assets/images/photos/50.jpg')}}" class="img-responsive" alt="loading">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <img src="{{asset('assets/images/photos/31.jpg')}}" class="img-responsive" alt="loading">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <img src="{{asset('assets/images/photos/26.jpg')}}" class="img-responsive" alt="loading">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <img src="{{asset('assets/images/photos/8.jpg')}}" class="img-responsive" alt="loading">
                <div class="carousel-caption">
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#slider" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#slider" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
<br>