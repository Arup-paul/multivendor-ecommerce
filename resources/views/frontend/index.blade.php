 @extends('frontend.layouts.layouts')

       @section('frontend_css')
            <style>
                .category-image img{
                    width: 150px !important;
                    height: 150px !important;
                }
            </style>
       @endsection
     @section('content')

         @if($sliders->count() > 0)
             @include('frontend.layouts.banner')
         @endif

         <div class="wrap-category xs-margin-top-80px">
             <div class="container container-xxl">
                 <div class="biolife-title-box style-02 xs-margin-bottom-33px">
                     <h3 class="main-title">Featured Categories</h3>

                 </div>
                 <ul class="biolife-carousel nav-center-bold nav-none-on-mobile" data-slick='{"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 3}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}, {"breakpoint":500, "settings":{ "slidesToShow": 1}}]}'>

                     @foreach($categories as $category)
                         <li>
                             <div class="biolife-cat-box-item">
                                 <div class="cat-thumb category-image">
                                     <a href="{{$category->url}}" class="cat-link">
                                         <img src="{{asset($category->category_image)}}" width="277" height="185" alt="">
                                     </a>
                                 </div>
                                 <a class="cat-info" href="{{$category->url}}">
                                     <h4 class="cat-name">{{ucfirst($category->category_name)}}</h4>
                                     <span class="cat-number">({{$category->products_count}} items)</span>
                                 </a>
                             </div>
                         </li>


                     @endforeach

                 </ul>

             </div>
         </div>


         <div class="product-tab z-index-20 sm-margin-top-30px xs-margin-top-30px">
             <div class="container container-xxl">
                 <div class="biolife-title-box mb-10">
                     <h3 class="main-title">Just Landing</h3>
                 </div>
                 <div class="block-item recently-products-cat md-margin-bottom-39">
                     <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>

                         @foreach($newProducts as $product)
                             @include('frontend.products.product')
                         @endforeach

                     </ul>
                 </div>
             </div>
         </div>

         <div class="product-tab z-index-20 sm-margin-top-30px xs-margin-top-30px">
             <div class="container container-xxl">
                 <div class="biolife-title-box mb-10">
                     <h3 class="main-title">Best Seller Products</h3>
                 </div>
                 <div class="block-item recently-products-cat md-margin-bottom-39">
                     <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>

                     @foreach($bestSellerProducts as $product)
                             @include('frontend.products.product')
                         @endforeach

                     </ul>
                 </div>
             </div>
         </div>

         <div class="product-tab z-index-20 sm-margin-top-30px xs-margin-top-30px">
             <div class="container container-xxl">
                 <div class="biolife-title-box mb-10">
                     <h3 class="main-title">Discount Products</h3>
                 </div>
                 <div class="block-item recently-products-cat md-margin-bottom-39">
                     <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>

                     @foreach($discountProducts as $product)
                             @include('frontend.products.product')
                         @endforeach

                     </ul>
                 </div>
             </div>
         </div>
         <div class="product-tab z-index-20 sm-margin-top-30px xs-margin-top-30px">
             <div class="container container-xxl">
                 <div class="biolife-title-box mb-10">
                     <h3 class="main-title">Featured Products</h3>
                 </div>
                 <div class="block-item recently-products-cat md-margin-bottom-39">
                     <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                       @foreach($featuredProducts as $product)
                             @include('frontend.products.product')
                         @endforeach

                     </ul>
                 </div>
             </div>
         </div>
         <div class="product-tab z-index-20 sm-margin-top-30px xs-margin-top-30px">
             <div class="container container-xxl">
                 <div class="biolife-title-box mb-10">
                     <h3 class="main-title">Best Rated Products</h3>
                 </div>
                 <div class="block-item recently-products-cat md-margin-bottom-39">
                     <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>

                      @foreach($bestRatedProducts as $product)
                             @include('frontend.products.product')
                         @endforeach

                     </ul>
                 </div>
             </div>
         </div>





            <!--Block 07: Brands-->
         <div class="product-tab z-index-20 sm-margin-top-30px xs-margin-top-30px">
             <div class="container container-xxl">
                 <div class="biolife-title-box mb-10">
                     <h3 class="main-title">Popular Brands</h3>
                 </div>
                 <div class="block-item recently-products-cat md-margin-bottom-39">
                     <ul class="biolife-carousel nav-center-bold nav-none-on-mobile" data-slick='{"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 3}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}, {"breakpoint":500, "settings":{ "slidesToShow": 1}}]}'>

                         @foreach($brands as $brand)
                             <li>
                                 <div class="biolife-cat-box-item">
                                     <div class="cat-thumb category-image">
                                         <a href="#" class="cat-link">
                                             <img src="{{asset($brand->image)}}" width="277" height="185" alt="">
                                         </a>
                                     </div>
                                     <a class="cat-info" href="#">
                                         <h4 class="cat-name">{{ucfirst($brand->name)}}</h4>
{{--                                         <span class="cat-number">({{$category->products_count}} items)</span>--}}
                                     </a>
                                 </div>
                             </li>


                         @endforeach

                     </ul>
                 </div>
             </div>
         </div>

            <!--Block 08: Blog Posts-->
            <div class="blog-posts sm-margin-top-93px sm-padding-top-72px xs-padding-bottom-50px">
                <div class="container container-xxl">
                    <div class="biolife-title-box">
                        <h3 class="main-title">Our Blog</h3>
                    </div>
                    <ul class="biolife-carousel nav-center nav-none-on-mobile xs-margin-top-36px" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":3, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 2}},{"breakpoint":768, "settings":{ "slidesToShow": 2}},{"breakpoint":600, "settings":{ "slidesToShow": 1}}]}'>
                      @foreach($blogs as $blog)

                        <li>
                            <div class="post-item effect-01 style-bottom-info layout-02 ">
                                <div class="thumbnail">
                                    <a href="{{route('blog.details',$blog->slug)}}" class="link-to-post"><img src="{{asset($blog->image)}}" width="370" height="300" alt=""></a>

                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">{{$blog->title}}</a></h4>
                                    <div class="post-meta">
                                        <a href="#" class="post-meta__item author"><i class="fa fa-user"></i><span> Admin</span></a>
                                        <a href="#" class="post-meta__item btn liked-count">{{formatted_date($blog->created_at)}}</a>

                                    </div>
                                    <p class="excerpt">{{Str::limit($blog->short_description ?? null, 100, $end='.......')}}  </p>
                                    <div class="group-buttons">
                                        <a href="{{route('blog.details',$blog->slug)}}" class="btn readmore">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </li>


                        @endforeach

                    </ul>
                </div>
            </div>

  @endsection

