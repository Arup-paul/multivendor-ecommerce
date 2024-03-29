<li class="product-item product-item-new">
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
                    <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$discount}}</span></ins>
                    <del><span class="price-amount"><span class="currencySymbol">$</span>{{$product->product_price}}</span></del>
                @else
                    <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$product->product_price}}</span></ins>
                @endif

            </div>
            <form action="{{route('cart.add')}}" method="post" class="cartForm">
                @csrf

                <input type="hidden" name="product_id" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                <input type="hidden" name="qty" value="1"   class="cart_product_price_{{$product->id}}">
                @if(isset($product->attributes[0]))
                  <input type="hidden" name="size" value="{{$product->attributes[0]->size}}"  class="cart_product_size_{{$product->id}}">

                 @else
                    <input type="hidden"  value="No Size" class="cart_product_size_{{$product->id}}">
                @endif
                <div class="slide-down-box">
                    <div class="buttons">
                        <button type="button" class="btn new-btn-icon -btn mr-5 addWishlist"    data-productid="{{$product->id}}"><i class="fa fa-heart" aria-hidden="true"></i></button>
                        <button type="submit" class="btn cart-btn new-btn-icon" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>  </button>
                        <button type="button" class="btn new-btn-icon -btn mr-5 addCompareProduct"   data-productid="{{$product->id}}"><i class="fa fa-random" aria-hidden="true"></i></button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</li>


