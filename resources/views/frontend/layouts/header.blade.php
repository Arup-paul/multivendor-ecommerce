   <!-- HEADER -->
  <header id="header" class="header-area style-01 layout-03">
    <div class="header-top header-bg hidden-xs">
        <div class="container container-xxl">
            <div class="top-bar left">
                <ul class="horizontal-menu">

                    <li class="menu-item"> <a href="{{route('seller.login')}}" class="link-to-item"> <i class="fa fa-user-circle"></i>Seller Login</a>   </li>
                    <li class="menu-item"> <a href="#" class="link-to-item"> <i class="fa fa-venus-double"></i>Order Tracking</a>   </li>
                </ul>
            </div>
            <div class="top-bar right">
                <ul class="horizontal-menu">
                    <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> 019999999</a></li>
                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Organic@company.com</a></li>
                    <li class="horz-menu-item lang">
                        <select name="language">
                            <option value="fr">French (EUR)</option>
                            <option value="en" selected>English (USD)</option>
                            <option value="ger">Germany (GBP)</option>
                            <option value="jp">Japan (JPY)</option>
                        </select>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="header-middle  ">
        <div class="container container-xxl">
            <div class="row">
                <div class="col-lg-3 col-md-2 col-md-6 col-xs-6">
                    <a href="{{route('home')}}" class="biolife-logo"><img src="{{asset('frontend/assets/images/organic-3.png')}}" alt="biolife logo" width="135" height="34"></a>
                </div>
                <div class="col-lg-6 col-md-7 hidden-sm hidden-xs">
                    <div class="header-search-bar layout-01">
                        <form action="{{route('shop')}}" class="form-search" method="post">
                            @csrf
                            <input type="text" name="search" class="input-text" value="" placeholder="Search here...">
                            <select name="category">
                                <option value="-1" selected>All Sections</option>
                                @foreach($sections as $section)
                                    <option value="">{{$section->name}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-submit"><i class="biolife-icon icon-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-md-6 col-xs-6">

                    <div class="biolife-cart-info">
                        <div class="mobile-search">
                            <a href="javascript:void(0)" class="open-searchbox"><i class="biolife-icon icon-search"></i></a>
                            <div class="mobile-search-content">
                                <form action="{{route('shop')}}" class="mobile-search" method="post">
                                    @csrf
                                    <a href="#" class="btn-close"><span class="biolife-icon icon-close-menu"></span></a>
                                    <input type="text" name="search" class="input-text" value="" placeholder="Search here...">
                                    <select name="category">
                                        <option value="0" selected>All Sections</option>
                                        @foreach($sections as $section)
                                            <option value="">{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn-submit">go</button>
                                </form>
                            </div>
                        </div>
                        <div class="wishlist-block hidden-sm hidden-xs">
                            <a href="#" class="link-to">
                                    <span class="icon-qty-combine">
                                        <i class="icon-heart-bold biolife-icon"></i>
                                        <span class="qty">4</span>
                                    </span>
                            </a>
                        </div>

                        <div id="appendMiniCartItem">
                            @include('frontend.layouts.minicart')
                        </div>


                        <div class="mobile-menu-toggle">
                            <a class="btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom biolife-sticky-object hidden-sm hidden-xs">
        <div class="container container-xxl">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="vertical-menu vertical-category-block">
                        <div class="block-title">
                            <span class="menu-icon">
                                <span class="line-1"></span>
                                <span class="line-2"></span>
                                <span class="line-3"></span>
                            </span>
                            <span class="menu-title">All departments</span>
                            <span class="angle" data-tgleclass="fa fa-caret-down"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                        </div>
                        <div class="wrap-menu">
                            <ul class="menu clone-main-menu">
                                @foreach($sections as $section)
                                    <li class="menu-item menu-item-has-children has-megamenu">
                                        <a href="javascript:;" class="menu-name" data-title="{{$section->name}}"><i class="biolife-icon icon-fruits"></i>{{$section->name}}  </a>
                                         @if(count($section->categories) > 0)
                                           <div class="wrap-megamenu width-400">
                                            <div class="mega-content">
                                                <div class="row">


                                                    <div class="  col-sm-12 xs-margin-bottom-25  ">
                                                        @foreach($section->categories as $category)
                                                        <div class="wrap-custom-menu vertical-menu">
                                                            <h4><a href="{{url($category->url)}}" class="menu-title">{{$category->category_name}}</a></h4>
                                                            <ul class="menu">
                                                                @foreach($category->subcategories as $subcategory)
                                                                    <li><a href="{{url($subcategory->url)}}">{{$subcategory->category_name}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        @endforeach
                                                    </div>




                                                </div>
                                            </div>
                                        </div>
                                         @endif
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 padding-top-2px">

                    <div class="primary-menu">
                        <ul class="menu biolife-menu clone-main-menu clone-primary-menu" id="primary-menu" data-menuname="main menu">
                            <li class="menu-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="menu-item"><a href="{{route('shop')}}">Shop</a></li>
                            <li class="menu-item"><a href="#">Blog</a></li>
                            <li class="menu-item"><a href="{{route('contact')}}">Contact</a></li>
                            @guest
                                <li class="menu-item"><a href="{{route('login')}}">Signup/Login</a></li>
                            @endguest
                            @auth
                                <li class="menu-item"><a href="{{route('user.dashboard')}}">Account</a></li>
                                <li class="menu-item"><a href="{{route('logout')}}">Logout</a></li>
                            @endauth

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
