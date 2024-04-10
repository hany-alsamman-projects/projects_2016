<!-- START SLIDER fullwidth mode -->

<div class="fullwidthbanner-container roundedcorners">
    <div class="fullwidthbanner" >
        <ul>
            @foreach(iProductController::ProductsIntro() as $product)

            <!-- SLIDE  -->
            <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
                <!-- MAIN IMAGE -->
                <img src="{{asset('assets/images/slidebg1.jpg')}}"  alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                <!-- LAYERS -->

                <!-- LAYER NR. 1 -->
                <div class="tp-caption customin customout"
                     data-x="center" data-hoffset="100"
                     data-y="top" data-voffset="100"
                     data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                     data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                     data-speed="800"
                     data-start="700"
                     data-easing="Power4.easeOut"
                     data-endspeed="500"
                     data-endeasing="Power4.easeIn"
                     style="z-index: 3">
                    <div style="width: 600px; height: 200px; background-color: white">
                    </div>
                </div>
                <!-- LAYER NR. 1 -->
                <div class="tp-caption modern_big_redbg lfl customout tp-resizeme"
                     data-x="400"
                     data-y="122"
                     data-customout="x:0;y:180;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                     data-speed="1000"
                     data-start="2000"
                     data-easing="Power4.easeInOut"
                     data-endspeed="300"
                     style="z-index: 4">{{ $product->title }}
                </div>
                <!-- LAYER NR. 2 -->
                <div class="tp-caption text-box customout tp-resizeme"
                     data-x="400"
                     data-y="172"
                     data-customout="x:0;y:180;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                     data-speed="1000"
                     data-start="2300"
                     data-easing="Power4.easeInOut"
                     data-endspeed="300"
                     style="z-index: 5; color: #000">
                    <p style="position: relative;">
                        {{ Str::limit($product->subject,
                        300) }}
                    </p>
                </div>
                <!-- LAYER NR. 3 -->
                <div class="tp-caption lfl customout tp-resizeme"
                     data-x="900"
                     data-y="252"
                     data-customout="x:0;y:180;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                     data-speed="1000"
                     data-start="2300"
                     data-easing="Power4.easeInOut"
                     data-endspeed="300"
                     style="z-index: 6;">
                    <a style="font-size: 13pt; color: #0d4b86" href="{{ URL::to("en/products/view/$product->id") }}">More
                        <img src="{{asset('assets/images/more_button.jpg')}}" />
                    </a>
                </div>
                <!-- LAYER NR. 4 -->
                <div class="tp-caption large_bold_grey skewfromrightshort customout"
                     data-x="100"
                     data-y="76"
                     data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                     data-speed="500"
                     data-start="800"
                     data-easing="Back.easeOut"
                     data-endspeed="500"
                     data-endeasing="Power4.easeIn"
                     data-captionhidden="off"
                     style="z-index: 4">
                    <img height="310" src="{{asset("assets/data/covers/$product->photo")}}" />

                </div>
            </li>

            @endforeach
        </ul>
        <div class="tp-bannertimer"></div>
    </div>
</div>
<!-- END SLIDER -->