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
                        <span class="subtitle">The freshest and most exciting news</span>
                        <h3 class="main-title">From the Blog</h3>
                    </div>
                    <ul class="biolife-carousel nav-center nav-none-on-mobile xs-margin-top-36px" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":3, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 2}},{"breakpoint":768, "settings":{ "slidesToShow": 2}},{"breakpoint":600, "settings":{ "slidesToShow": 1}}]}'>
                        <li>
                            <div class="post-item effect-01 style-bottom-info layout-02 ">
                                <div class="thumbnail">
                                    <a href="#" class="link-to-post"><img src="assets/images/our-blog/post-thumb-01.jpg" width="370" height="270" alt=""></a>
                                    <div class="post-date">
                                        <span class="date">26</span>
                                        <span class="month">dec</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">Ashwagandha: The #1 Herb in the World for Anxiety?</a></h4>
                                    <div class="post-meta">
                                        <a href="#" class="post-meta__item author"><img src="assets/images/home-03/post-author.png" width="28" height="28" alt=""><span>Admin</span></a>
                                        <a href="#" class="post-meta__item btn liked-count">2<span class="biolife-icon icon-comment"></span></a>
                                        <a href="#" class="post-meta__item btn comment-count">6<span class="biolife-icon icon-like"></span></a>
                                        <div class="post-meta__item post-meta__item-social-box">
                                            <span class="tbn"><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                                            <div class="inner-content">
                                                <ul class="socials">
                                                    <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="excerpt">Did you know that red-staining foods are excellent lymph-movers? In fact, many plants that were historically used as dyes...</p>
                                    <div class="group-buttons">
                                        <a href="#" class="btn readmore">continue reading</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-item effect-01 style-bottom-info layout-02">
                                <div class="thumbnail">
                                    <a href="#" class="link-to-post"><img src="assets/images/our-blog/post-thumb-02.jpg" width="370" height="270" alt=""></a>
                                    <div class="post-date">
                                        <span class="date">26</span>
                                        <span class="month">dec</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">Ashwagandha: The #1 Herb in the World for Anxiety?</a></h4>
                                    <div class="post-meta">
                                        <a href="#" class="post-meta__item author"><img src="assets/images/home-03/post-author.png" width="28" height="28" alt=""><span>Admin</span></a>
                                        <a href="#" class="post-meta__item btn liked-count">2<span class="biolife-icon icon-comment"></span></a>
                                        <a href="#" class="post-meta__item btn comment-count">6<span class="biolife-icon icon-like"></span></a>
                                        <div class="post-meta__item post-meta__item-social-box">
                                            <span class="tbn"><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                                            <div class="inner-content">
                                                <ul class="socials">
                                                    <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="excerpt">Did you know that red-staining foods are excellent lymph-movers? In fact, many plants that were historically used as dyes...</p>
                                    <div class="group-buttons">
                                        <a href="#" class="btn readmore">continue reading</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-item effect-01 style-bottom-info layout-02">
                                <div class="thumbnail">
                                    <a href="#" class="link-to-post"><img src="assets/images/our-blog/post-thumb-04.jpg" width="370" height="270" alt=""></a>
                                    <div class="post-date">
                                        <span class="date">26</span>
                                        <span class="month">dec</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">Ashwagandha: The #1 Herb in the World for Anxiety?</a></h4>
                                    <div class="post-meta">
                                        <a href="#" class="post-meta__item author"><img src="assets/images/home-03/post-author.png" width="28" height="28" alt=""><span>Admin</span></a>
                                        <a href="#" class="post-meta__item btn liked-count">2<span class="biolife-icon icon-comment"></span></a>
                                        <a href="#" class="post-meta__item btn comment-count">6<span class="biolife-icon icon-like"></span></a>
                                        <div class="post-meta__item post-meta__item-social-box">
                                            <span class="tbn"><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                                            <div class="inner-content">
                                                <ul class="socials">
                                                    <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="excerpt">Did you know that red-staining foods are excellent lymph-movers? In fact, many plants that were historically used as dyes...</p>
                                    <div class="group-buttons">
                                        <a href="#" class="btn readmore">continue reading</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-item effect-01 style-bottom-info layout-02">
                                <div class="thumbnail">
                                    <a href="#" class="link-to-post"><img src="assets/images/our-blog/post-thumb-03.jpg" width="370" height="270" alt=""></a>
                                    <div class="post-date">
                                        <span class="date">26</span>
                                        <span class="month">dec</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">Ashwagandha: The #1 Herb in the World for Anxiety?</a></h4>
                                    <div class="post-meta">
                                        <a href="#" class="post-meta__item author"><img src="assets/images/home-03/post-author.png" width="28" height="28" alt=""><span>Admin</span></a>
                                        <a href="#" class="post-meta__item btn liked-count">2<span class="biolife-icon icon-comment"></span></a>
                                        <a href="#" class="post-meta__item btn comment-count">6<span class="biolife-icon icon-like"></span></a>
                                        <div class="post-meta__item post-meta__item-social-box">
                                            <span class="tbn"><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                                            <div class="inner-content">
                                                <ul class="socials">
                                                    <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="excerpt">Did you know that red-staining foods are excellent lymph-movers? In fact, many plants that were historically used as dyes...</p>
                                    <div class="group-buttons">
                                        <a href="#" class="btn readmore">continue reading</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-item effect-01 style-bottom-info layout-02">
                                <div class="thumbnail">
                                    <a href="#" class="link-to-post"><img src="assets/images/our-blog/post-thumb-05.jpg" width="370" height="270" alt=""></a>
                                    <div class="post-date">
                                        <span class="date">26</span>
                                        <span class="month">dec</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">Ashwagandha: The #1 Herb in the World for Anxiety?</a></h4>
                                    <div class="post-meta">
                                        <a href="#" class="post-meta__item author"><img src="assets/images/home-03/post-author.png" width="28" height="28" alt=""><span>Admin</span></a>
                                        <a href="#" class="post-meta__item btn liked-count">2<span class="biolife-icon icon-comment"></span></a>
                                        <a href="#" class="post-meta__item btn comment-count">6<span class="biolife-icon icon-like"></span></a>
                                        <div class="post-meta__item post-meta__item-social-box">
                                            <span class="tbn"><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                                            <div class="inner-content">
                                                <ul class="socials">
                                                    <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="excerpt">Did you know that red-staining foods are excellent lymph-movers? In fact, many plants that were historically used as dyes...</p>
                                    <div class="group-buttons">
                                        <a href="#" class="btn readmore">continue reading</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="post-item effect-01 style-bottom-info layout-02">
                                <div class="thumbnail">
                                    <a href="#" class="link-to-post"><img src="assets/images/our-blog/post-thumb-06.jpg" width="370" height="270" alt=""></a>
                                    <div class="post-date">
                                        <span class="date">26</span>
                                        <span class="month">dec</span>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">Ashwagandha: The #1 Herb in the World for Anxiety?</a></h4>
                                    <div class="post-meta">
                                        <a href="#" class="post-meta__item author"><img src="assets/images/home-03/post-author.png" width="28" height="28" alt=""><span>Admin</span></a>
                                        <a href="#" class="post-meta__item btn liked-count">2<span class="biolife-icon icon-comment"></span></a>
                                        <a href="#" class="post-meta__item btn comment-count">6<span class="biolife-icon icon-like"></span></a>
                                        <div class="post-meta__item post-meta__item-social-box">
                                            <span class="tbn"><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                                            <div class="inner-content">
                                                <ul class="socials">
                                                    <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="excerpt">Did you know that red-staining foods are excellent lymph-movers? In fact, many plants that were historically used as dyes...</p>
                                    <div class="group-buttons">
                                        <a href="#" class="btn readmore">continue reading</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

  @endsection

