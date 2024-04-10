<li class="accordion-group">
    <div class="accordion-heading"> <a href="{{URL::to('admin')}}" data-item="dashboard_menu"  class="accordion-toggle"> <span class="item-icon fontello-icon-monitor"></span>
            Dashboards </a> </div>
</li>

@if(Sentry::getUser()->isSuperUser())

<li class="accordion-group">
    <div class="accordion-heading"> <a href="#pages_menu" data-item="pages_menu" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon aweso-icon-list-alt"></span>
            Pages Management </a> </div>
    <ul class="accordion-content nav nav-list collapse" id="pages_menu">
        <li> <a href="{{URL::to('admin/page/create')}}">Add Page </a> </li>
        <li> <a href="{{URL::to('admin/page')}}">Show Pages </a> </li>
    </ul>
</li>

<li class="accordion-group">
    <div class="accordion-heading"> <a href="#groups_menu" data-item="groups_menu" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon aweso-icon-list-alt"></span>
            Groups Management </a> </div>
    <ul class="accordion-content nav nav-list collapse" id="groups_menu">
        <li> <a href="{{URL::to('admin/groups')}}">Show Groups </a> </li>
        <li> <a href="{{URL::to('admin/groups/create')}}">Create Group </a> </li>
    </ul>
</li>

<li class="accordion-group">
    <div class="accordion-heading"> <a href="#users_menu" data-item="users_menu"  data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon aweso-icon-list-alt"></span>
            Users Management </a> </div>
    <ul class="accordion-content nav nav-list collapse" id="users_menu">
        <li> <a href="{{URL::to('admin/users')}}">Show Accounts </a> </li>
        <li> <a href="{{URL::to('admin/users/create')}}">Add Account </a> </li>
    </ul>
</li>

@endif

<script>

// check where we go :P
$("div.accordion-heading").delegate("a.accordion-toggle",'click',function(){
    // the name "link" containing this anchor's id attribute
    eraseCookie('get_link');
    var themenu = $(this).data('item');
    createCookie('get_link', themenu, 1);
});

//check last item is selected assholes :D
var lastLink = $.cookie('get_link');

if(lastLink != false){
    //$('.accordion-heading').find("[data-item='" + lastLink + "']").addClass('collapsed');
    $('ul#'+lastLink).removeClass("collapse").addClass('in collapse');
}

function createCookie(name, value, days) {
    if (days) {

        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";

    document.cookie = name + "=" + value + expires + "; path=/";
    this[name] = value;
}

function eraseCookie(cookiename) {
    this.createCookie(cookiename, '', -1);
    this[cookiename] = undefined;
}


</script>