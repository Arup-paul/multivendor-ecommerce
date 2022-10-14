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
            <li class="menu-header">Starter</li>
            @if(auth()->guard('admin')->user()->type == 'vendor')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Vendor Details</span></a>
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
                        <span>{{ __('Admin Management') }}</span>
                    </a>
            </li>

            <li class="{{ Request::is('admin/media*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.media.list') }}">
                    <i class="far fa-file-image"></i>
                    <span>{{ __('Media') }}</span>
                </a>
            </li>

         @endif

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
