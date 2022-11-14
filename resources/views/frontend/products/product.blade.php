<li class="product-item">
    <div class="contain-product layout-default">
        <div class="product-thumb">
            <a href="{{route('product.details',$product->slug)}}" class="link-to-product">
                <img src="{{asset($product->product_image)}}" alt="{{$product->product_name}}" width="270" height="270" class="product-thumnail">
            </a>
        </div>
        <div class="info">
            <b class="categories"><a href="{{url($product->category->url)}}">{{$product->category->category_name}}&nbsp;</a>/&nbsp;<a href="">{{$product->brand->name}}</a></b>
            <b class="categories">{{$product->product_color}}</b>
            <h4 class="product-title"><a href="{{route('product.details',$product->slug)}}" class="pr-name">{{$product->product_name}}</a></h4>
             @php
                 $discount =\App\Models\Product::getDiscountPrice($product->id)
             @endphp
            <div class="price ">
                @if( $discount != 0)
                    <ins><span class="price-amount"><span class="currencySymbol">৳</span>{{$discount}}</span></ins>
                    <del><span class="price-amount"><span class="currencySymbol">৳</span>{{$product->product_price}}</span></del>
                @else
                    <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$product->product_price}}</span></ins>
                @endif

            </div>
            <div class="slide-down-box">
                <p class="message">{{$product->description ?? null}}</p>
                <div class="buttons">
                    <a href="#" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                    <a href="#" class="btn compare-btn"><i class="fa fa-random" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</li>
