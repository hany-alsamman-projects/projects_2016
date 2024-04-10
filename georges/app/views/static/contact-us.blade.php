<section id="contents">
    <div class="container">
        <div class="careers" style="clear: both;">
            <div style="width: 950px">
                <div style="width: 40%; float: right; margin-right: 15px; margin-top: 15px;">

                <div id="map-canvas">
                    <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Riyadh+13241,+Saudi+Arabia+AL+HAMRA+OASIS+VILLAGE+COMPOUND+(AOVC).&amp;sll=24.791332,46.727905&amp;sspn=0.002092,0.002411&amp;ie=UTF8&amp;hq=&amp;hnear=&amp;ll=24.791332,46.727905&amp;spn=0.006295,0.006295&amp;t=m&amp;output=embed"></iframe>
                </div>
                <p style="clear: both"></p>
                    <div style="position: relative; width: 100%">
                        <p>
                            {{ Page::where('static', 1)->where('slug', Request::segment(2))->first()->content }}
                        </p>
                    </div>
                </div>
                @if (Session::has('flash_error'))

                <div id="contactus" style="margin-bottom: 15px; margin-top: 15px">
                    <div id="contactus-ct">
                        <div id="contactus-header">
                            <h2><img src="{{asset('assets/images/good.png')}}"> Your Message has been sent</h2>
                        </div>
                        <div style="padding: 5px">
                            <p>we will get back to you soon as possible ..</p>
                        </div>
                    </div>
                </div>

                @else

                <div id="contactus" style="margin-bottom: 15px; margin-top: 15px">
                    <div id="contactus-ct">
                        <div id="contactus-header">
                            <h2>Send us your detail inquiry and we will get back</h2>
                            <p>to you as soon as possible</p>
                        </div>
                        <form action="{{ route('contactus') }}" method="post">
                            <div class="txt-fld">
                                <label>Full name:</label>
                                <input class="form-control" type="text"  name="full_name"/>
                            </div>
                            <div class="txt-fld">
                                <label>Mobile:</label>
                                <input class="form-control" type="text" name="phone_number"/>
                            </div>
                            <div class="txt-fld">
                                <label>Country:</label>
                                <input class="form-control" type="text" name="residence"/>
                            </div>
                            <div class="txt-fld">
                                <label>Occupation:</label>
                                <input class="form-control" type="text" name="career"/>
                            </div>
                            <div class="txt-fld">
                                <label>Company:</label>
                                <input class="form-control" type="text" name="company"/>
                            </div>
                            <div class="txt-fld">
                                <label>Subject:</label>
                                <input class="form-control" type="text" name="subject"/>
                            </div>

                            <div class="txt-fld">
                                <label>Message:</label>
                                <textarea  class="form-control" cols="30" rows="4" name="messages"></textarea>
                            </div>
                            <div class="btn-fld">
                                <button type="submit">Send &raquo;</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>