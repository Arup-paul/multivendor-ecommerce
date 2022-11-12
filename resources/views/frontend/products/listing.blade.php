@php
    use \App\Models\ProductFilter;
    $productFilters = ProductFilter::getFilter();
    $productSizes =  ProductFilter::getSizes($url);
@endphp

@extends('frontend.layouts.layouts')
@section('content')

   @include('frontend.partials.breadcrumb', ['title' => $breadCrumb->category_name,'image' => $breadCrumb->category_image])
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                @if($parentCategory)
                    <li class="nav-item"><a href="{{url($parentCategory->url)}}" class="permal-link">{{$parentCategory->category_name}}  </a></li>
                @endif
                <li class="nav-item"><a href="{{url($breadCrumb->url)}}" class="permal-link">{{$breadCrumb->category_name}}</a></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain category-page left-sidebar">
        <div class="container">
            <div class="row">
                <!-- Main content -->
                <div id="main-content" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">



                    <div class="product-category grid-style">

                        <div id="top-functions-area" class="top-functions-area" >
                            <div class="flt-item to-left group-on-mobile">
                                <span class="flt-title">Refine</span>
                                <a href="#" class="icon-for-mobile">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="wrap-selectors">
                                    <form action="#" name="frm-refine" method="get">
                                        <span class="title-for-mobile">Refine Products By</span>
                                        <div data-title="Price:" class="selector-item">
                                            <select name="price" class="selector">
                                                <option value="all">Price</option>
                                                <option value="class-1st">Less than 5$</option>
                                                <option value="class-2nd">$5-10$</option>
                                                <option value="class-3rd">$10-20$</option>
                                                <option value="class-4th">$20-45$</option>
                                                <option value="class-5th">$45-100$</option>
                                                <option value="class-6th">$100-150$</option>
                                                <option value="class-7th">More than 150$</option>
                                            </select>
                                        </div>
                                        <div data-title="Brand:" class="selector-item">
                                            <select name="brad" class="selector">
                                                <option value="all">Top brands</option>
                                                <option value="br2">Brand first</option>
                                                <option value="br3">Brand second</option>
                                                <option value="br4">Brand third</option>
                                                <option value="br5">Brand fourth</option>
                                                <option value="br6">Brand fiveth</option>
                                            </select>
                                        </div>
                                        <div data-title="Avalability:" class="selector-item">
                                            <select name="ability" class="selector">
                                                <option value="all">Availability</option>
                                                <option value="vl2">Availability 1</option>
                                                <option value="vl3">Availability 2</option>
                                                <option value="vl4">Availability 3</option>
                                                <option value="vl5">Availability 4</option>
                                                <option value="vl6">Availability 5</option>
                                            </select>
                                        </div>
                                        <p class="btn-for-mobile"><button type="submit" class="btn-submit">Go</button></p>
                                    </form>
                                </div>
                            </div>
                            <div class="flt-item to-right">
                                <span class="flt-title">Sort</span>
                                <div class="wrap-selectors">

                                        <div class="selector-item orderby-selector">
                                            <form name="sortProducts" id="sortProducts">
                                                <input type="hidden" name="url" id="url" value="{{$url}}">
                                            <select name="sort" id="sort" class="orderby" aria-label="Shop order">
                                                <option value="" selected="selected">sorting</option>
                                                <option value="latest" @if(isset($_GET['sort']) && $_GET['sort'] == 'latest') selected @endif>Latest</option>
                                                <option value="lowest-price" @if(isset($_GET['sort']) && $_GET['sort'] == 'lowest-price') selected @endif>price: low to high</option>
                                                <option value="highest-price" @if(isset($_GET['sort']) && $_GET['sort'] == 'highest-price') selected @endif>price: high to low</option>
                                                <option value="name-a-z" @if(isset($_GET['sort']) && $_GET['sort'] == 'name-a-z') selected @endif >Sort: Name A-Z</option>
                                                <option value="name-z-a" @if(isset($_GET['sort']) && $_GET['sort'] == 'name-z-a') selected @endif >Sort: Name Z-A</option>
                                            </select>
                                            </form>
                                        </div>

                                    <div class="selector-item viewmode-selector">
                                        <a href="category-grid-left-sidebar.html" class="viewmode grid-mode active"><i class="biolife-icon icon-grid"></i></a>
                                        <a href="category-list-left-sidebar.html" class="viewmode detail-mode"><i class="biolife-icon icon-list"></i></a>
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
                            @if(isset($_GET['sort']))
                                {{$products->appends(['sort' => $_GET['sort']])->links('vendor.pagination.custom')}}
                            @else
                                {{$products->links('vendor.pagination.custom')}}
                            @endif
                        </div>

                    </div>

                </div>
                <!-- Sidebar -->
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
            //sorting filter
            $('#sort').on('change', function() {
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
                        sort:sort,url:url,
                    },
                    success:function(data) {
                        $('.filter-products').html(data);
                    },error:function() {
                        Notify('error', 'Oops! Something went wrong');
                    }
                })
            });

            //size filtering
            $('.size').on('change', function() {
                var size = get_filter('size');
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
                        sort:sort,url:url,size:size
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
                      sort:sort,url:url,
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
