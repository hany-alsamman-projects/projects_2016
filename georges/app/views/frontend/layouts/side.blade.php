<div class="col-sm-4">
    <div class="panel panel-new">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-location-arrow"></i> Contact Details</h3>
        </div>
        <div class="panel-body">
            <address>
                {{ Page::where('static', 1)->where('slug', 'contact-us')->first()->content }}
            </address>
            <hr>
            <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Riyadh+13241,+Saudi+Arabia+AL+HAMRA+OASIS+VILLAGE+COMPOUND+(AOVC).&amp;sll=24.791332,46.727905&amp;sspn=0.002092,0.002411&amp;ie=UTF8&amp;hq=&amp;hnear=&amp;ll=24.791332,46.727905&amp;spn=0.006295,0.006295&amp;t=m&amp;output=embed"></iframe>
        </div>
    </div>
</div><!--/.col-sm-4 -->
