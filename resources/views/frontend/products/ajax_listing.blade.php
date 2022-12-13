@if($products->count() >  0)
    <div class="row">
        <ul class="products-list filter-products">
    @foreach($products as $product)
    <li class="product-item @if(isset($vendor)) col-lg-2 col-md-3 col-sm-4 col-xs-6 @else col-lg-3 col-md-3 col-sm-4 col-xs-6 @endif">
        <div class="contain-product layout-default">
            <div class="product-thumb">
                <a href="{{route('product.details',$product->slug)}}" class="link-to-product">
                    <img src="{{asset($product->product_image)}}" alt="{{$product->product_name}}" width="270" height="270" class="product-thumnail">
                </a>
            </div>
            <div class="info">
                <b class="categories"><a href="{{url($product->category->url)}}">{{$product->category->category_name}}</a>&nbsp;/&nbsp;<a
                        href="">{{$product->brand->name}}</a></b>
                <b class="categories">{{$product->product_color}}</b>
                <h4 class="product-title"><a href="{{route('product.details',$product->slug)}}" class="pr-name">{{$product->product_name}}</a></h4>
                <div class="price">
                    @php
                        $discount =\App\Models\Product::getDiscountPrice($product->id)
                    @endphp
                    @if($product->product_discount == 0)
                        <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$product->product_price}} </span></ins>
                    @else
                        <ins><span class="price-amount"><span class="currencySymbol">৳</span>{{$discount}}</span></ins>
                        <del><span class="price-amount"><span class="currencySymbol">$</span>{{$product->product_price}}</span></del>
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
                            <a href="#" class="btn wishlist-btn new-btn-icon"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            <button type="submit" class="btn cart-btn new-btn-icon" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>  </button>
                            <a href="#" class="btn compare-btn new-btn-icon"><i class="fa fa-random" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </li>
@endforeach
        </ul>
    </div>
     <div class="biolife-panigations-block">

            {{$products->links('vendor.pagination.custom')}}
    </div>
@else
    <div class="row">
        <ul class="products-list filter-products text-center">
            Product Not found
        </ul>
    </div>
@endif




