@extends('frontend.layouts.layouts')
@section('content')

    <div class="container sm-margin-top-37px">
        <h3 class="box-title">Checkout</h3>
        <div class="row">


            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                <div class="order-summary sm-margin-bottom-80px">
                    <div class="title-block">
                        <h3 class="title">Order Summary</h3>
                        <a href="{{route('cart')}}" class="link-forward">View Cart</a>
                    </div>
                    <div class="cart-list-box short-type">
                        <span class="number">{{total_cart_items()}} item</span>
                        <ul class="cart-list">
                            @php
                                $total = 0;
                            @endphp
                            @foreach($cartItems as $item)
                                @php
                                    $discount =\App\Models\Product::getDiscountPrice($item->product_id)
                                @endphp
                                <li class="cart-elem">
                                    <div class="cart-item">
                                        <div class="product-thumb">
                                            <a class="prd-thumb" href="#">
                                                <figure><img src="{{$item->product->product_image ?? ''}}" width="113" height="113" alt="shop-cart" ></figure>
                                            </a>
                                        </div>
                                        <div class="info">
                                            <span class="txt-quantity">{{$item->quantity}}X</span>
                                            <a href="{{route('product.details',$item->product->slug)}}" class="pr-name">{{$item->product->product_name}}</a>
                                        </div>
                                        <div class="price price-contain">
                                            @if( $discount != 0)
                                                <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$discount}}</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">$</span>{{$item->product->product_price}}</span></del>
                                            @else
                                                <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$item->product->product_price}}</span></ins>
                                            @endif
                                        </div>
                                    </div>
                                </li>

                                @php
                                    if($discount != 0){
                                        $total += $discount * $item->quantity;
                                    }else{
                                       $total += $item->product->product_price * $item->quantity;
                                    }
                                @endphp
                            @endforeach

                        </ul>
                        <ul class="subtotal">
                            <li>
                                <div class="subtotal-line">
                                    <b class="stt-name">Subtotal</b>
                                    <span class="stt-price">${{$total}}</span>
                                </div>
                            </li>
                            <li>
                                <div class="subtotal-line">
                                    <b class="stt-name">Shipping</b>
                                    <span class="stt-price">$0.00</span>
                                </div>
                            </li>
                            <li>
                                <div class="subtotal-line">
                                    <b class="stt-name">Coupon Discount</b>
                                    <span class="stt-price">
                                        @if(Session::has('couponAmount'))
                                            $ {{Session::get('couponAmount')}}
                                        @else
                                            $ 0
                                        @endif
                                     </span>
                                </div>
                            </li>
                            <li>
                                <div class="subtotal-line">
                                    <b class="stt-name">Tax</b>
                                    <span class="stt-price">$0.00</span>
                                </div>
                            </li>

                            <li>
                                <div class="subtotal-line">
                                    <b class="stt-name">total:</b>
                                    <span class="stt-price">
                                         @if(Session::has('grandTotal'))
                                            $ {{Session::get('grandTotal')}}
                                        @else
                                            $  {{$total}}
                                        @endif
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!--checkout progress box-->
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <form action="{{route('checkout')}}" method="post" class="ajaxform">
                    @csrf
                   <div class="checkout-progress-wrap">
                    <ul class="steps">
                        <li class="step 1st">
                            <div class="checkout-act active">
                                <h3 class="title-box">Delivery Addresses <a href="{{route('user.delivery-address.create')}}" class="add_delivery">Add new </a></h3>
                                 <div class="row delivery_box">
                                     @foreach($deliveryAddress as $address)
                                       <div class="col-md-6 col-12">
                                         <div class="delivery_address">
                                             <div class="row">
                                                 <div class="col-xs-9">
                                                     <input name="delivery_address" type="radio" value="{{$address->id}}" id="address-{{$address->id}}"> <br>
                                                     <label for="address-{{$address->id}}">
                                                         <h6><span>Name: </span>{{$address->name}}</h6>
                                                         <h6><span>Mobile: </span>{{$address->mobile}}</h6>
                                                         <h6><span>Email: </span>{{$address->email}}</h6>
                                                         <h6><span>Address Type: </span>{{$address->address_type}}</h6>
                                                         <h6><span>Zip Code: </span>{{$address->zip}}</h6>
                                                         <h6><span>Address: </span>{{$address->address}},{{$address->city}},{{$address->state}},{{$address->country}}</h6>
                                                     </label>
                                                 </div>
                                                 <div class="col-xs-3">
                                                     <a href="{{route('user.delivery-address.edit',$address->id)}}">Edit</a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     @endforeach

                                 </div>

                            </div>
                        </li>
                        <li class="step 1st">
                            <div class="checkout-act active">
                                <h3 class="title-box">Pay With </h3>
                                <div class="row  ">
                                        <div class="col-md-6 col-12">
                                            <div class="payment-methods">
                                                <input type="radio" id="cod" name="payment_gateway" value="COD">
                                                <img for="cod" src="{{asset('frontend/img/cash-on-delivery.jpg')}}" width="200" height="200" alt="">
                                            </div>
                                        </div>

                                </div>

                            </div>
                        </li>
                        <li>
                            <div class="pull-right">
                                 <button type="submit" class="btn-placeorder ">Place Order</button>

                            </div>
                        </li>

                    </ul>
                </div>
                </form>
            </div>


        </div>
    </div>

@endsection
