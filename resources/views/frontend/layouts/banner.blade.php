<div class="main-slide block-slider">
    <ul class="biolife-carousel nav-none-on-mobile" data-slick='{"arrows": true, "dots": false, "slidesMargin": 0, "slidesToShow": 1, "infinite": true, "speed": 800}' >
        @foreach($sliders as $slider)
            <li>
                <div class="slide-contain slider-opt03__layout01">
                    <div class="media" style="background-image:url({{asset($slider['value']['banner'])}})">
                        @if($slider['value']['child_image'])
                        <div class="child-elememt">
                                <img src="{{asset($slider['value']['child_image'] ?? null)}}" width="604" height="580" alt="">
                        </div>
                        @endif
                    </div>
                    <div class="text-content">
                        <h3 class="second-line">{{$slider['value']['title'] ?? null}}</h3>
                        <p class="third-line">{{$slider['value']['short_title'] ?? null}}</p>
                        @if($slider['value']['button_text'])
                        <p class="buttons">
                            <a href="{{$slider['value']['button_link'] ?? null}}" class="btn btn-bold">{{$slider['value']['button_text'] ?? null}}</a>
                        </p>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
</div>
