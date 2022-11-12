<aside id="sidebar" class="sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">
    <div class="biolife-mobile-panels">
        <span class="biolife-current-panel-title">Sidebar</span>
        <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">&times;</a>
    </div>
    <div class="sidebar-contain">

        @foreach($productFilters as $filter)
            @php $filterAvailable = ProductFilter::filterAvailable($filter->id,$category->id);  @endphp
            @if($filterAvailable)
                @if(count($filter->filterValues) > 0)
                    <div class="widget biolife-filter">
                        <h4 class="wgt-title">{{$filter->filter_name}}</h4>
                        <div class="wgt-content">
                            <div class="check-list-new ">
                                @foreach($filter->filterValues as $filter_value)
                                    <div>
                                        <input type="checkbox" class="{{$filter->filter_column}}"
                                               id="{{$filter_value->filter_value}}"
                                               value="{{$filter_value->filter_value}}"
                                               name="{{$filter->filter_column}}[]"
                                        >
                                        <label for="{{$filter_value->filter_value}}" class=" ">{{$filter_value->filter_value}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach


        <div class="widget biolife-filter">
            <h4 class="wgt-title">Size</h4>
            <div class="wgt-content">
                <div class="check-list-new ">
                    @foreach($productSizes as $key => $size)
                        <div>
                            <input type="checkbox" class="size"
                                   id="size{{$key}}"
                                   value="{{$size}}"
                                   name="size[]"
                            >
                            <label for="size{{$key}}" class=" ">{{ucwords($size)}}</label>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
        <div class="widget price-filter biolife-filter">
            <h4 class="wgt-title">Price</h4>
            <div class="wgt-content">
                <div class="frm-contain">
                    <form action="#" name="price-filter" id="price-filter" method="get">
                        <p class="f-item">
                            <label for="pr-from">$</label>
                            <input class="input-number" type="number" id="pr-from" value="" name="price-from">
                        </p>
                        <p class="f-item">
                            <label for="pr-to">to $</label>
                            <input class="input-number" type="number" id="pr-to" value="" name="price-from">
                        </p>
                        <p class="f-item"><button class="btn-submit" type="submit">go</button></p>
                    </form>
                </div>

            </div>
        </div>

        <div class="widget biolife-filter">
            <h4 class="wgt-title">Color</h4>
            <div class="wgt-content">
                <div class="check-list-new ">
                    @foreach($productColors as $key => $color)
                        <div>
                            <input type="checkbox" class="product_color"
                                   id="product_color{{$key}}"
                                   value="{{$color}}"
                                   name="product_color[]"
                            >
                            <label for="product_color{{$key}}" class=" ">{{ucwords($color)}}</label>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>




    </div>

</aside><?php
