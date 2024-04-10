<div class="row-fluid page-head">
    <h2 class="page-title heading-icon" data-icon="&#xe10e;" aria-hidden="true">Accounts
        <small>Management</small>
    </h2>
    <p class="pagedesc"></p>
</div>
<!-- // page head -->

<div id="page-content" class="page-content">
<div class="navbar navbar-page">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>

            <div class="nav-collapse collapse navbar-responsive-collapse">
                <div class="btn-toolbar pull-right">
                    <button id="resetFilter" class="btn btn-red">Reset Filter</button>
                    <button id="resetAll" class="btn btn-red">Reset All</button>
                </div>
                <form class="navbar-form pull-right margin-right5" action="#">
                    <div class="input-append">
                        <input class="span2 search" id="contactSearch" type="text" placeholder="Search Contact">

                        <div class="btn-group">
                            <button class="btn btn-yellow dropdown-toggle" data-toggle="dropdown">Filter Action <span
                                    class="caret"></span></button>
                            <ul id="actionForList" class="dropdown-menu pull-right">
                                <li class="nav-header">Sort by ...</li>
                                <li><a href="javascript:void(0);" class="sort" data-sort="name">Name</a></li>
                                <li><a href="javascript:void(0);" class="sort" data-sort="city">City</a></li>
                                <li class="divider"></li>
                                <li class="nav-header">Filter by ...</li>
                                    <span data-filter-property='type'>
                                        <li><a href="javascript:void(0);" class="filter"
                                               data-filter-set='Work'>Work</a></li>
                                        <li><a href="javascript:void(0);" class="filter"
                                               data-filter-set='Friends'>Friend</a></li>
                                    </span><span data-filter-property='gender'>
                                        <li><a href="javascript:void(0);" class="filter"
                                               data-filter-set='Male'>Male</a></li>
                                        <li><a href="javascript:void(0);" class="filter"
                                               data-filter-set='Female'>Female</a></li>
                                    </span>
                            </ul>
                        </div>
                    </div>
                </form>
                <ul class="nav nav-icon">
                    <li class="active"><a class="btn-icon tip" href="#" title="contacts"><i
                                class="fontello-icon-vcard"></i></a></li>
                    <li><a class="btn-icon tip" href="#" title="user"><i
                                class="fontello-icon-user"></i></a></li>
                    <li><a class="btn-icon tip" href="#" title="last update" data-toggle="modal"><i
                                class="fontello-icon-arrows-cw"></i></a></li>
                </ul>

            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<section>
<div class="row-fluid">
    <div class="span12">
        <div id="myContact-nav" class="nav-alphabet alphabet-btn"></div>
    </div>
</div>
<div class="row-fluid">
<div class="span12 well well-nice">
<div class="row-fluid ">

<!--<div class="stacx4"> -->
<div class="span10">
    <div id="myContactWrap" class="scrollBox4 nav-list-wrap" style="height: 660px;">
        <ul id="myContact" class="nav nav-contact list list-bordered thumb-small">
            @foreach($users as $user)
            <li>
            <div class="media"><span class="media-thumb media-left img-shadow" href="#">
            @if($user->avatar == false)
            <img class="media-object thumb" src="/assets/admin/img/demo/demo-avatar9606.jpg">
            @else
            <img class="media-object thumb" src="/upload/avatars/{{ $user->avatar }}">
            @endif
            </span>
            <div class="media-body">
            <h4 class="media-heading name">{{ $user->first_name }}</h4>
                <span>
                <span class="phone fontello-icon-user"><a href="{{URL::to("admin/users/$user->id/edit")}}">Edit</a></span>
                <span class="phone fontello-icon-trash"><a href="{{URL::to("admin/users/$user->id/delete")}}">Remove</a></span>
                </span>
            </div>
            <span class="city hidden">{{ $user->first_name }}</span>
            <span class="country hidden">USA</span>
            <span class="gender hidden">Female</span> <span class="hidden type">Work</span>
            </div>

            @endforeach
            </li>
        </ul>
    </div>
</div>

</div>
</div>
</div>
<!-- // Example row -->
</section>
</div>
<!-- // page content -->

<script>
    // EQUALIZE PLUGIN
    // ------------------------------------------------------------------------------------------------ * -->
    // pl-content/equalize/js/equalize.js
    // Set Equal Height for tabs
    $('#equalizeContent').equalize({ children: '.equalize' });

    // FILTERABLE LIST
    // ------------------------------------------------------------------------------------------------ * -->
    // pl-content/list/js/list.min.js
    // pl-content/list/js/list.paging.min.js
    // pl-content/list/js/list.fuzzySearch.min.js
    // pl-content/list/js/list.filter.min.js

    $(function () {
        // Option for list
        var options = {
            valueNames: ['name', 'phone', 'gender', 'type', 'city'],
            plugins: [
                ['fuzzySearch'],
                ['filtering', {}]
            ]
        };

        var contactList = new List('main-content', options);

        $('#resetFilter').click(function () {
            contactList.filter();
            $("#actionForList a").parent().removeClass("active");
            return false;
        });

        $('#resetAll').click(function () {
            contactList.search();
            contactList.filter();
            $('#contactSearch').val('');
            return false;
        });

        $('#actionForList a').click(function () {
            $("#actionForList a").parent().removeClass("active");
            $(this).parent().addClass("active");
        });

        // search contact
        $('#contactSearch').keyup(function () {
            contactList.fuzzySearch($(this).val());
        });
    });

    $(document).ready(function () {

        $('#myContact div.media').click(function () {
            $("#myContact div.media").parent().removeClass("active");
            $(this).parent().addClass("active");
        });

        // LISTNAV
        // ------------------------------------------------------------------------------------------------ * -->
        // pl-content/jquery.listnav/js/jquery.listnav.js
        $('#myContact').listnav({
            initLetter: '',
            includeAll: true,
            incudeOther: false,
            includeNums: true,
            flagDisabled: true,
            noMatchText: 'No matching entries',
            showCounts: true,
            cookieName: "demo-nav-contact",
            onClick: function (letter) {
                $("#myContactWrap.scrollBox4").getNiceScroll().resize();
                $('#myContact li').addClass('animated fadeIn');
            },
            prefixes: []
        });

        $('.ln-letter-count').addClass('animated fadeIn');

    });
</script>