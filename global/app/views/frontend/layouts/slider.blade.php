<div class="fullwidthbanner-container">
    <div class="fullwidthabnner">
        <ul>

            <li data-transition="random" data-slotamount="1" data-masterspeed="300" data-thumb="images/thumbs/thumb6.jpg')}}">
                <img src="{{asset('assets/images/slider/slide/bg_1.jpg')}}" >

                <div class="caption sfb" data-x="680" data-y="40" data-speed="1500" data-start="1000" data-easing="easeOutSine">
                    <img src="{{asset('assets/images/slider/slide/img_1.png')}}">
                </div>

                <div class="caption modern_medium_fat sft" data-x="10" data-y="10" data-speed="500" data-start="1200" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide/img_6.png')}}">
                </div>

                <div class="caption sfb"  data-x="150" data-y="80" data-speed="500" data-start="1500" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide/img_2.png')}}">
                </div>

                <div class="caption sft" data-x="20" data-y="180" data-speed="1000" data-start="1500" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide/img_3.png')}}">
                </div>

                <div class="caption sft" data-x="20" data-y="230" data-speed="1000" data-start="1600" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide/img_4.png')}}">
                </div>

                <div class="caption sft" data-x="20" data-y="280" data-speed="1000" data-start="1700" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide/img_5.png')}}">
                </div>
            </li>

            <li data-transition="random" data-slotamount="1" data-masterspeed="300" data-thumb="images/thumbs/thumb6.jpg')}}">
                <img src="{{asset('assets/images/slider/slide2/bg.jpg')}}" >

                <div class="caption sfb" data-x="0" data-y="40" data-speed="900" data-start="1000" data-easing="easeOutSine">
                    <img src="{{asset('assets/images/slider/slide2/img_1.png')}}">
                </div>

                <div class="caption lft"  data-x="500" data-y="80" data-speed="500" data-start="1500" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide2/img_2.png')}}">
                </div>

                <div class="caption sfb"  data-x="500" data-y="180" data-speed="500" data-start="1500" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide2/img_3.png')}}">
                </div>
            </li>

            <li data-transition="papercut" data-slotamount="1" data-masterspeed="300" data-thumb="images/thumbs/thumb6.jpg')}}">
                <img src="{{asset('assets/images/slider/slide3/bg_0.png')}}" >

                <div class="caption sfb" data-x="700" data-y="100" data-speed="1200" data-start="1200" data-easing="easeOutSine">
                    <img src="{{asset('assets/images/slider/slide3/bg_3.png')}}">
                </div>

                <div class="caption sfb" data-x="0" data-y="200" data-speed="1200" data-start="700" data-easing="easeOutSine">
                    <img src="{{asset('assets/images/slider/slide3/bg_1.png')}}">
                </div>

                <div class="caption sfb" data-x="300" data-y="150" data-speed="1200" data-start="1200" data-easing="easeOutSine">
                    <img src="{{asset('assets/images/slider/slide3/bg_2.png')}}">
                </div>

                <div class="caption sft" data-x="250" data-y="20" data-speed="1000" data-start="1500" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide3/img_1.png')}}">
                </div>

                <div class="caption sft" data-x="200" data-y="50" data-speed="1000" data-start="1600" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide3/img_2.png')}}">
                </div>

                <div class="caption sft" data-x="80" data-y="80" data-speed="1000" data-start="1700" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide3/img_3.png')}}">
                </div>

                <div class="caption sfb" data-x="10" data-y="80" data-speed="1200" data-start="2100" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide3/img_5.png')}}">
                </div>

                <div class="caption sfb" data-x="900" data-y="80" data-speed="1200" data-start="2500" data-easing="easeOutExpo">
                    <img src="{{asset('assets/images/slider/slide3/img_4.png')}}">
                </div>
            </li>
        </ul>

        <div class="tp-bannertimer"></div>
    </div>
</div>
<script>
    var api;
    jQuery(document).ready(function() {
        api =  jQuery('.fullwidthabnner').revolution(
            {
                delay:9000,
                startheight:350,
                startwidth:1100,

                hideThumbs:10,

                thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                thumbHeight:50,
                thumbAmount:5,

                navigationType:"both",					//bullet, thumb, none, both		(No Thumbs In FullWidth Version !)
                navigationArrows:"verticalcentered",		//nexttobullets, verticalcentered, none
                navigationStyle:"round",				//round,square,navbar

                touchenabled:"on",						// Enable Swipe Function : on/off
                onHoverStop:"on",						// Stop Banner Timet at Hover on {{asset('assets/images/slider/slide on/off

                navOffsetHorizontal:0,
                navOffsetVertical:20,

                stopAtSlide:-1,
                stopAfterLoops:-1,

                shadow: 3,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
                fullWidth:"off",							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
                fullScreen:"off",
                fullScreenOffsetContainer:".header"
            });
    });
</script>
