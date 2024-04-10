<header>
    <div class="container">
        <div class="row">
            <div id="logo" class="col-md-6">
                <a href="{{ URL::to('/') }}"><img src="{{asset('assets/images/logo.png')}}" alt="Company name" class="img-responsive"></a>
            </div>
            <!--
            <div class="col-md-6">
                <div class="well well-sm visible-lg">
                    <form method="post" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            -->
        </div>
    </div>
</header>

<div class="container">
    <div id="social" class="pull-right">
        <a href="#" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
        <a href="#" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>
        <a href="#" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a>
        <a href="#" target="_blank"><i class="fa fa-youtube-square fa-2x"></i></a>
        <a href="#" target="_blank"><i class="fa fa-rss fa-2x"></i></a>
    </div>
</div>

<div class="container">

    <nav class="navbar navbar-danger" role="navigation">

        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">

                    <li {{ Request::is('/') ? ' class="active"' : '' }}>
                    <a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a></li>

                    @foreach(HomeController::MainPages() as $page)
                    @if($page->slug != 'home')

                        @if(HomeController::SubPages($page->id))
                            <li {{ Request::is("page/$page->slug") ? ' class="active"' : '' }} class="dropdown">

                            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::to("/page/$page->slug") }}">
                            <i class="fa fa-th"></i> {{$page->title}}</a>
                        @else

                            <li {{ Request::is("page/$page->slug") ? ' class="active"' : '' }}>
                            <a href="{{ URL::to("/page/$page->slug") }}">
                            <i class="fa fa-th"></i> {{$page->title}}</a>
                        @endif

                    @endif
                        @if(HomeController::SubPages($page->id))
                        <ul class="dropdown-menu">
                            @foreach(HomeController::SubPages($page->id) as $subpage)
                            <li><a href="{{ URL::to("/page/$subpage->slug") }}">{{$subpage->title}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    </li>
                    @endif
                    @endforeach

                    <li {{ Request::is('page/request') ? ' class="active"' : '' }}><a href="{{ URL::to('/page/request') }}"><i class="fa fa-building-o"></i> Rent Request</a></li>

                    <li {{ Request::is('page/contact-us') ? ' class="active"' : '' }}><a href="{{ URL::to('/page/contact-us') }}"><i class="fa fa-envelope"></i> Contact us</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if(!Sentry::check())
                    <li><a href="{{ route('signin') }}"><i class="fa fa-sign-in"></i> Sign in</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" style="overflow: hidden; text-overflow: ellipsis; max-width: 90px; white-space:nowrap;" data-toggle="dropdown"><b class="caret"></b> {{ Sentry::getUser()->first_name }}</a>
                        <ul class="dropdown-menu">
                        <li><a style="overflow: hidden; text-overflow: ellipsis; max-width: 150px; white-space:nowrap;" href="#"><i class="fa fa-user"></i> {{ Sentry::getUser()->first_name }}</a></li>
                        <li class="divider"></li>
                        <li{{ Request::is('account') ? ' class="active"' : '' }}><a href="{{ URL::route('account') }}">Dashboard</a></li>
                        <li{{ Request::is('account/profile') ? ' class="active"' : '' }}><a href="{{ URL::route('profile') }}">Profile</a></li>
                        <li{{ Request::is('account/change-password') ? ' class="active"' : '' }}><a href="{{ URL::route('change-password') }}">Change Password</a></li>
                        <li{{ Request::is('account/change-email') ? ' class="active"' : '' }}><a href="{{ URL::route('change-email') }}">Change Email</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ URL::to('auth/logout') }}" class="button glossy orange-gradient"> Sign Out</a></li>
                </ul>
                </li>
                @endif
                </ul>


            </div><!--/.nav-collapse -->
        </div>

    </nav>
</div>