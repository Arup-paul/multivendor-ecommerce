<aside class="user-info-wrapper">
    <div class="user-info">
        <div class="user-avatar">
            <img id="avater_photo_view" src="https://geniusdevs.com/codecanyon/omnimart40/assets/images/16385217454444.jpg" alt="User">
        </div>

        <div class="user-data">
            <h4 class="h5">Alex Smith</h4><span>Joined Sep Mon 2021</span>
        </div>
    </div>
    <nav class="list-group">
        <a class="list-group-item {{ Request::is('user/dashboard*') ? 'active' : '' }} " href="{{route('user.dashboard')}}" href="#"><i class="icon-command"></i>Dashboard</a>
        <a class="list-group-item  {{ Request::is('user/orders*') ? 'active' : '' }} " href="{{route('user.orders.index')}}"><i class="icon-command"></i>Orders</a>
        <a class="list-group-item  {{ Request::is('user/review*') ? 'active' : '' }} " href="{{route('user.review.index')}}"><i class="icon-command"></i>Review</a>
    </nav>
</aside>
