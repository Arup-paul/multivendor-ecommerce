@extends('frontend.layouts.layouts')
@section('content')

   @include('frontend.partials.breadcrumb', ['title' => $breadCrumb->category_name,'image' => $breadCrumb->category_image])
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                @if($parentCategory)
                    <li class="nav-item"><a href="{{url($parentCategory->url)}}" class="permal-link">{{$parentCategory->category_name}}</a></li>
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
                            <ul class="products-list">

                                @foreach($products as $product)
                                    <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <div class="contain-product layout-default">
                                            <div class="product-thumb">
                                                <a href="#" class="link-to-product">
                                                    <img src="{{asset($product->product_image)}}" alt="{{$product->product_name}}" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories"><a href="">{{$product->category->category_name}}</a>&nbsp;/&nbsp;<a
                                                        href="">{{$product->brand->name}}</a></b>
                                                <b class="categories">{{$product->product_color}}</b>
                                                <h4 class="product-title"><a href="#" class="pr-name">{{$product->product_name}}</a></h4>
                                                <div class="price">
                                                    @php
                                                        $discount =\App\Models\Product::getDiscountPrice($product->id)
                                                    @endphp
                                                    @if($discount != 0)
                                                        <ins><span class="price-amount"><span class="currencySymbol">৳</span>{{$discount}}</span></ins>
                                                        <del><span class="price-amount"><span class="currencySymbol">৳</span>{{$product->product_price}}</span></del>
                                                    @else
                                                        <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$product->product_price}}</span></ins>
                                                    @endif
                                                </div>
                                                <div class="shipping-info">
                                                    <p class="shipping-day">3-Day Shipping</p>
                                                    <p class="for-today">Pree Pickup Today</p>
                                                </div>
                                                <div class="slide-down-box">
                                                    <p class="message">All products are carefully selected to ensure food safety.</p>
                                                    <div class="buttons">
                                                        <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                        <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                        <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach



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
                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Departements</h4>
                            <div class="wgt-content">
                                <ul class="cat-list">
                                    <li class="cat-list-item"><a href="#" class="cat-link">Organic Food</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Fresh Fruit</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Dried Fruits</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Shipping & Pickup</h4>
                            <div class="wgt-content">
                                <ul class="cat-list">
                                    <li class="cat-list-item"><a href="#" class="cat-link">Show all</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">2- Day shipping</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Shop to Home</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Free Pickup</a></li>
                                </ul>
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
                                <ul class="check-list bold single">
                                    <li class="check-list-item"><a href="#" class="check-link">$0 - $5</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">$5 - $10</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">$15 - $20</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Brand</h4>
                            <div class="wgt-content">
                                <ul class="check-list multiple">
                                    <li class="check-list-item"><a href="#" class="check-link">Great Value Organic</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">Plum Organic</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">Shop to Home</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Color</h4>
                            <div class="wgt-content">
                                <ul class="color-list">
                                    <li class="color-item"><a href="#" class="c-link"><span class="symbol img-color"></span>Multi</a></li>
                                    <li class="color-item"><a href="#" class="c-link"><span class="symbol hex-code color-01"></span>Red</a></li>
                                    <li class="color-item"><a href="#" class="c-link"><span class="symbol hex-code color-02"></span>Orrange</a></li>
                                    <li class="color-item"><a href="#" class="c-link"><span class="symbol hex-code color-03"></span>Other</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Popular Size</h4>
                            <div class="wgt-content">
                                <ul class="check-list bold multiple">
                                    <li class="check-list-item"><a href="#" class="check-link">8oz</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">15oz</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">6oz</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">30oz</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Number of Pieces</h4>
                            <div class="wgt-content">
                                <ul class="check-list bold">
                                    <li class="check-list-item"><a href="#" class="check-link">1 to 9</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">10 to 15</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Recently Viewed</h4>
                            <div class="wgt-content">
                                <ul class="products">
                                    <li class="pr-item">
                                        <div class="contain-product style-widget">
                                            <div class="product-thumb">
                                                <a href="#" class="link-to-product" tabindex="0">
                                                    <img src="assets/images/products/p-13.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories">Fresh Fruit</b>
                                                <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="pr-item">
                                        <div class="contain-product style-widget">
                                            <div class="product-thumb">
                                                <a href="#" class="link-to-product" tabindex="0">
                                                    <img src="assets/images/products/p-14.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories">Fresh Fruit</b>
                                                <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="pr-item">
                                        <div class="contain-product style-widget">
                                            <div class="product-thumb">
                                                <a href="#" class="link-to-product" tabindex="0">
                                                    <img src="assets/images/products/p-10.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories">Fresh Fruit</b>
                                                <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Product Tags</h4>
                            <div class="wgt-content">
                                <ul class="tag-cloud">
                                    <li class="tag-item"><a href="#" class="tag-link">Fresh Fruit</a></li>
                                    <li class="tag-item"><a href="#" class="tag-link">Natural Food</a></li>
                                    <li class="tag-item"><a href="#" class="tag-link">Hot</a></li>
                                    <li class="tag-item"><a href="#" class="tag-link">Organics</a></li>
                                    <li class="tag-item"><a href="#" class="tag-link">Dried Organic</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
@endsection
