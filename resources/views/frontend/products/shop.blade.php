@php
    use \App\Models\ProductFilter;
    $productFilters = ProductFilter::getFilter();

@endphp

@extends('frontend.layouts.layouts')
@section('content')

    <div class="container container-xxl">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="{{route('home')}}" class="permal-link">Home</a></li>
                <li class="nav-item"><a href="{{route('shop')}}" class="permal-link">Shop</a></li>
            </ul>
        </nav>
    </div>

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
                                             <input type="hidden" name="url" id="url" value="{{route('shop')}}">
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

                        @include('frontend.products.ajax_listing')

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
                      @endforeach




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
                    url: url,
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
