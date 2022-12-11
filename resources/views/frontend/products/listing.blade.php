@php
    use \App\Models\ProductFilter;
    $productFilters = ProductFilter::getFilter();
    $productSizes =  ProductFilter::getSizes($url);
    $productColors =  ProductFilter::getColors($url);
    $productBrands =  ProductFilter::getBrands($url);

@endphp

@extends('frontend.layouts.layouts')
@section('content')

   @include('frontend.partials.category_nav')

    <div class="page-contain category-page left-sidebar">
        <div class="container container-xxl">
            <div class="row">
                <!-- Main content -->
                <div id="main-content" class="main-content col-lg-10 col-md-9 col-sm-12 col-xs-12">



                    <div class="product-category grid-style">

                        <div id="top-functions-area" class="top-functions-area" >
                            <div class="flt-item to-left group-on-mobile">

                                <div class="wrap-selectors">

                                </div>
                            </div>
                            <div class="flt-item to-right">
                                <div class="wrap-selectors">
                                        <div class="selector-item orderby-selector">
                                            <form name="sortProducts" id="sortProducts">
                                                <input type="hidden" name="url" id="url" value="{{$url}}">
                                            <select name="sort" id="sort" class="orderby" aria-label="Shop order">
                                                <option value="" selected="selected">Sorting</option>
                                                <option value="latest" @if(isset($_GET['sort']) && $_GET['sort'] == 'latest') selected @endif>Latest</option>
                                                <option value="lowest-price" @if(isset($_GET['sort']) && $_GET['sort'] == 'lowest-price') selected @endif>price: low to high</option>
                                                <option value="highest-price" @if(isset($_GET['sort']) && $_GET['sort'] == 'highest-price') selected @endif>price: high to low</option>
                                                <option value="name-a-z" @if(isset($_GET['sort']) && $_GET['sort'] == 'name-a-z') selected @endif >Sort: Name A-Z</option>
                                                <option value="name-z-a" @if(isset($_GET['sort']) && $_GET['sort'] == 'name-z-a') selected @endif >Sort: Name Z-A</option>
                                            </select>
                                            </form>
                                        </div>


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <ul class="products-list filter-products">
                              @include('frontend.products.ajax_listing')
                            </ul>
                        </div>

                        <div class="biolife-panigations-block">
                            @if(isset($_GET['sort']) || isset($_GET['size']) || isset($_GET['color']) || isset($_GET['brand']))
                                {{ $products->appends(['sort' => $_GET['sort'], 'size' => $_GET['size'], 'color' => $_GET['color'], 'brand' => $_GET['brand']])->links('vendor.pagination.custom') }}
                            @else
                                {{$products->links('vendor.pagination.custom')}}
                            @endif
                        </div>

                    </div>

                </div>
                <!-- Sidebar -->
                <aside id="sidebar" class="sidebar col-lg-2 col-md-3 col-sm-12 col-xs-12">
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
                          <div class="widget biolife-filter">
                              <h4 class="wgt-title">Brand</h4>
                              <div class="wgt-content">
                                  <div class="check-list-new ">
                                      @foreach($productBrands as $key => $brand)
                                          <div>
                                              <input type="checkbox" class="brand"
                                                     id="brand{{$key}}"
                                                     value="{{$brand->id}}"
                                                     name="brand[]"
                                              >
                                              <label for="brand{{$key}}" class=" ">{{ucwords($brand->name)}}</label>
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
                                              <input class="input-number" type="text" id="pr-from" value="" name="price-from">
                                          </p>
                                          <p class="f-item">
                                              <label for="pr-to">to $</label>
                                              <input class="input-number" type="text" id="pr-to" value="" name="price-to">
                                          </p>
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

                </aside>
            </div>
        </div>
    </div>
@endsection

@section('frontend_scripts')
    <script >
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            //sorting, size,brand, product color filter
            $('#sort,.size,.brand,.product_color').on('change', function() {
                var sort = $("#sort").val();
                var size = get_filter('size');
                var product_color = get_filter('product_color');
                var url = $("#url").val();
                var price_from = $("#pr-from").val();
                var price_to = $("#pr-to").val();
                var brand = get_filter('brand');


                @foreach($productFilters as $filters)
                var {{$filters->filter_column}} = get_filter('{{$filters->filter_column}}');
                @endforeach
                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        @foreach($productFilters as $filters)
                            {{$filters->filter_column}}:{{$filters->filter_column}},
                        @endforeach
                        sort:sort,url:url,size:size,product_color:product_color,price_from:price_from,price_to:price_to,brand:brand
                    },
                    success:function(data) {
                        $('.filter-products').html(data);
                    },error:function() {
                        Notify('error', 'Oops! Something went wrong');
                    }
                })
            });



            $('.price-filter').on('keyup', function() {
                var price_from = $("#pr-from").val();
                var price_to = $("#pr-to").val();
                var size = get_filter('size');
                var product_color = get_filter('product_color');
                var sort = $("#sort").val();
                var url = $("#url").val();
                @foreach($productFilters as $filters)
                var {{$filters->filter_column}} = get_filter('{{$filters->filter_column}}');
                @endforeach
                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        @foreach($productFilters as $filters)
                            {{$filters->filter_column}}:{{$filters->filter_column}},
                        @endforeach
                        sort:sort,url:url,product_color:product_color,size:size,price_from:price_from,price_to:price_to
                    },
                    success:function(data) {
                        $('.filter-products').html(data);
                    },error:function() {
                        Notify('error', 'Oops! Something went wrong');
                    }
                })
            });


            @foreach($productFilters as $filter)
                //dynamic filtering
            $('.{{$filter->filter_column}}').on('click', function() {
                var url = $("#url").val();
                var sort = $("#sort option:selected").val();
                var size = get_filter('size');
                var product_color = get_filter('product_color');
                var price_from = $("#pr-from").val();
                var price_to = $("#pr-to").val();
                var brand = get_filter('brand');

                @foreach($productFilters as $filters)
                   var {{$filters->filter_column}} = get_filter('{{$filters->filter_column}}');
                @endforeach

                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        @foreach($productFilters as $filters)
                            {{$filters->filter_column}}:{{$filters->filter_column}},
                        @endforeach
                      sort:sort,url:url,size:size,product_color:product_color,price_from:price_from,price_to:price_to,brand:brand
                    },
                    success:function(data) {
                        $('.filter-products').html(data);
                    },error:function() {
                        Notify('error', 'Oops! Something went wrong');
                    }
                })
            });
            @endforeach

            function get_filter(class_name){
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }

        })
    </script>
@endsection
