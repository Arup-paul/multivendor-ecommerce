 @php
     $categoryModule =  \App\Models\Role::where('admin_id',auth()->guard('admin')->id())->where('module','categories')->first();
 @endphp
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard </li>
            <li class="nav-item  active">
                <a href="{{route('admin.dashboard')}}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">User Management </li>
            @if(auth()->guard('admin')->user()->type == 'vendor')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-app-store "></i> <span>Vendor Details</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.update-vendor-details','personal')}}">Personal Details</a></li>
                    <li><a class="nav-link" href="{{route('admin.update-vendor-details','business')}}">Business Details</a></li>
                    <li><a class="nav-link" href="{{route('admin.update-vendor-details','bank')}}">Bank Details</a></li>
                </ul>
            </li>
            @endif


            @if(auth()->guard('admin')->user()->type == 'superadmin')

             <li class="{{ Request::is('admin/admins*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.admins')}}">
                        <i class="fa fa-users"></i>
                        <span>{{ __('Admin/Subadmin') }}</span>
                    </a>
               </li>
                <li class="{{ Request::is('admin/vendors*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.vendors.index')}}">
                        <i class="fa fa-users"></i>
                        <span>{{ __('Vendor') }}</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/customers*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.customers.index') }}">
                        <i class="fa fa-users"></i>
                        <span>{{ __('Customer List') }}</span>
                    </a>
                </li>
            @endif
            <li class="menu-header">Ecommerce </li>

            <li class="nav-item dropdown {{ Request::is('admin/orders*') ? 'active' : '' }} ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"> <i class="fas fa-th-list"></i>
                    <span>{{ __('Manage Order') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/orders') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li class=""{{ Request::is('admin/orders-return') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.orders.return') }}">Return Orders</a></li>
                    <li class=""{{ Request::is('admin/orders-exchange') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.orders.exchange') }}">Exchange Orders</a></li>
                </ul>
            </li>

              @if(auth()->guard('admin')->user()->type == 'superadmin')

                <li class="{{ Request::is('admin/sections*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.sections.index')}}">
                        <i class="fa fa-puzzle-piece"></i>
                        <span>{{ __('Section') }}</span>
                    </a>
                </li>



                <li class="{{ Request::is('admin/brands*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.brands.index')}}">
                        <i class="fab fa-bandcamp"></i>
                        <span>{{ __('Brand') }}</span>
                    </a>
                </li>

            @endif
            @if(auth()->guard('admin')->user()->type == 'superadmin')
            <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('admin.categories.index')}}">
                    <i class="fa fa-tasks"></i>
                    <span>{{ __('Category') }}</span>
                </a>
            </li>
             @endif
            @if(auth()->guard('admin')->user()->type != 'vendor' && auth()->guard('admin')->user()->type != 'superadmin')
           @if($categoryModule->view || $categoryModule->all)
                <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">
                        <i class="fa fa-tasks"></i>
                        <span>{{ __('Category') }}</span>
                    </a>
                </li>
            @endif
            @endif


                <li class="nav-item dropdown {{ Request::is('admin/products*') ||  Request::is('admin/coupons*') ||  Request::is('admin/filters*') ||  Request::is('admin/filter-values*')  ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-product-hunt"></i> <span>Product</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('admin/products*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.products.index')}}"> {{ __('Products') }}</a></li>
                        <li class="{{ Request::is('admin/coupons*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.coupons.index')}}"> {{ __('Coupons') }}</a></li>
                        @if(auth()->guard('admin')->user()->type == 'superadmin')
                        <li class="{{ Request::is('admin/filters*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.filters.index')}}"> {{ __('Filter') }}</a></li>
                        <li class="{{ Request::is('admin/filter-values*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.filter-values.index')}}"> {{ __('Filter Value') }}</a></li>
                        @endif
                    </ul>
                </li>
            @if(auth()->guard('admin')->user()->type == 'superadmin')
                <li class="{{ Request::is('admin/shipping-charge*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.shipping-charge.index') }}">
                        <i class="fa fa-shipping-fast"></i>
                        <span>{{ __('Shipping Charge') }}</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/ratings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.ratings.index') }}">
                        <i class="fa fa-shipping-fast"></i>
                        <span>{{ __('Rating') }}</span>
                    </a>
                </li>
                <li class="menu-header">Settings </li>
            <li class="{{ Request::is('admin/media*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.media.list') }}">
                    <i class="far fa-file-image"></i>
                    <span>{{ __('Media') }}</span>
                </a>
            </li>

                <li class="{{ Request::is('admin/pages*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.pages.index') }}">
                        <i class="far fa-file-image"></i>
                        <span>{{ __('Pages') }}</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/blogs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.blogs.index') }}">
                        <i class="fa fa-blog"></i>
                        <span>{{ __('Blogs') }}</span>
                    </a>
                </li>


                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i> <span>Frontend Setting</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{route('admin.sliders.index')}}">Slider</a></li>
                    </ul>
                </li>


         @endif

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{route('home')}}" target="_blank" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Website
            </a>
        </div>
    </aside>
</div>
