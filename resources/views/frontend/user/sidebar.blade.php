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
        <a class="list-group-item {{ Request::is('user/dashboard*') ? 'active' : '' }} " href="{{route('user.dashboard')}}" href="#"><i class="fa fa-tachometer"></i> Dashboard</a>
        <a class="list-group-item  {{ Request::is('user/orders*') ? 'active' : '' }} " href="{{route('user.orders.index')}}"><i class="fa fa-shopping-bag"></i> Orders</a>
        <a class="list-group-item  {{ Request::is('user/wishlist*') ? 'active' : '' }} " href="{{route('user.wishlist.index')}}"><i class="fa fa-heart-o"></i> Wishlist</a>
        <a class="list-group-item  {{ Request::is('user/delivery-address*') ? 'active' : '' }} " href="{{route('user.delivery-address.index')}}"><i class="fa fa-map-o"></i> Address</a>
        <a class="list-group-item  {{ Request::is('user/review*') ? 'active' : '' }} " href="{{route('user.review.index')}}"><i class="fa fa-star"></i> Review</a>
        <a class="list-group-item"  href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
    </nav>
</aside>
