@php
    $cartItems = getCartItems();
@endphp
<div class="minicart-block">
    <div class="minicart-contain">
        <a href="javascript:void(0)" class="link-to">
                                        <span class="icon-qty-combine">
                                            <i class="icon-cart-mini biolife-icon"></i>
                                            <span class="qty totalCartItems" id="totalCartItems">{{total_cart_items()}}</span>
                                        </span>
            <span class="sub-total">$1.00</span>
        </a>
        <div class="cart-content">
            <div class="cart-inner">
                <ul class="products">
                    @php
                        $total = 0;
                        $totalQuantity = 0;
                    @endphp
                    @if($cartItems->count() > 0)
                        @foreach($cartItems as $items)
                            @php
                                $discount =\App\Models\Product::getDiscountPrice($items->product_id)
                            @endphp
                    <li>
                        <div class="minicart-item">
                            <div class="thumb">
                                <a href="#"><img src="{{asset($items->product->product_image ?? '')}}" width="90" height="90" alt="National Fresh"></a>
                            </div>
                            <div class="left-info">
                                <div class="product-title"><a href="{{route('product.details',$items->product->slug)}}" class="product-name">{{$items->product->product_name}}</a></div>
                                <div class="price">
                                    @if( $discount != 0)
                                        <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$items->quantity}} x {{$discount}} </span></ins>
                                    @else
                                        <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$items->product->product_price}}</span></ins>
                                    @endif
                                </div>
                            </div>
                            <div class="action">
                                <a href="#" class="remove removeCartItem " data-cartid="{{$items->id}}" data-url="{{route('cart.remove-item')}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </li>
                            @php
                                if($discount != 0){
                                    $total += $discount * $items->quantity;
                                }else{
                                   $total += $items->product->product_price * $items->quantity;
                                }
                                $totalQuantity += $items->quantity;

                            @endphp
                        @endforeach
                    @else
                        <li>
                            <div class="minicart-item">
                                <div class="left-info">
                                        <div class="product-title"><p class="product-name">Your cart is empty!</p></div>
                                </div>

                            </div>
                        </li>

                    @endif

                </ul>
                <li>
                    <div class="minicart-item">
                        <div class="left-info">
                            @if($total > 0 )
                            <div class="product-title"><p class="product-name">Subtotal: ${{$total}}</p></div>
                          @endif
                        </div>
                    </div>
                </li>

                <p class="btn-control">

                    <a href="{{route('cart')}}" class="btn   view-cart">cart</a>
                    <a href="{{route('checkout')}}" class="btn  ">checkout</a>
                </p>
            </div>
        </div>
    </div>
</div>
