<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{auth()->guard('admin')->user()->name}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                @if(auth()->guard('admin')->user()->type == 'superadmin')
                <a href="{{route('admin.update-profile-details')}}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> {{ __('Profile') }}
                </a>
                @endif

                <a href="{{route('admin.update-password')}}" class="dropdown-item has-icon">
                    <i class="fas fa-key"></i> Update Password
                </a>

                   @if(auth()->guard('admin')->user()->type == 'vendor')
                        <a href="{{route('seller.logout')}}" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    @else
                        <a href="{{route('admin.logout')}}" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    @endif
            </div>
        </li>
    </ul>
</nav>
