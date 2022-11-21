@extends('frontend.layouts.layouts')
@section('content')

    @include('frontend.partials.breadcrumb', ['title' =>'Shopping Cart'])
    <div class="container">
        <!--Cart Table-->
        <div class="shopping-cart-container  ">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="box-title">Your cart items</h3>
                    <form class="shopping-cart-form" action="#" method="post">
                        <table class="shop_table cart-form ">
                            <thead>
                            <tr>
                                <th class="product-name">Product Info</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-subtotal">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cartItems as $items)
                                @php
                                    $discount =\App\Models\Product::getDiscountPrice($items->product_id)
                                @endphp
                                <tr class="cart_item">
                                    <td class="product-thumbnail" data-title="Product Name">
                                        <a class="prd-thumb" href="#">
                                            <figure><img width="113" height="113" src="{{$items->product->product_image ?? ''}}" alt="shipping cart"></figure>
                                        </a>
                                        <a class="prd-name" href="{{route('product.details',$items->product->slug)}}">
                                            Name: <small>{{$items->product->product_name}}</small> <br>
                                            Color: <small> {{$items->product->product_color}}</small> <br>
                                            Code: <small> {{$items->product->product_code}}</small> <br>
                                            Size: <small> {{$items->size}}</small> <br>
                                        </a>
                                    </td>
                                    <td class="product-price" data-title="Price">
                                        <div class="price price-contain">
                                            @if( $discount != 0)
                                                <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$discount}}</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">$</span>{{$items->product->product_price}}</span></del>
                                            @else
                                                <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$items->product->product_price}}</span></ins>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="product-quantity" data-title="Quantity">
                                        <div class="quantity-box type1">
                                            <div class="qty-input">
                                                <input type="number" name="qty" value="{{$items->quantity}}" data-max_value="20" data-min_value="1" data-step="1" required>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="product-subtotal" data-title="Total">
                                        <div class="price price-contain">
                                            @if( $discount != 0)
                                            <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$discount * $items->quantity}}</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">$</span>{{$items->product->product_price  * $items->quantity}}</span></del>
                                            @else
                                                <ins><span class="price-amount"><span class="currencySymbol">$</span>{{$items->product->product_price  * $items->quantity}}</span></ins>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action">
                                            <a href="#" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            <tr class="cart_item wrap-buttons">
                                <td class="wrap-btn-control" colspan="4">
                                    <a class="btn back-to-shop">Back to Shop</a>
                                    <button class="btn btn-update" type="submit" disabled>update</button>
                                    <button class="btn btn-clear" type="reset">clear all</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="shpcart-subtotal-block">
                        <div class="subtotal-line">
                            <b class="stt-name">Subtotal <span class="sub">(2ittems)</span></b>
                            <span class="stt-price">£170.00</span>
                        </div>
                        <div class="subtotal-line">
                            <b class="stt-name">Shipping</b>
                            <span class="stt-price">£0.00</span>
                        </div>
                        <div class="tax-fee">
                            <p class="title">Est. Taxes & Fees</p>
                            <p class="desc">Based on 56789</p>
                        </div>
                        <div class="btn-checkout">
                            <a href="#" class="btn checkout">Check out</a>
                        </div>
                        <div class="biolife-progress-bar">
                            <table>
                                <tr>
                                    <td class="first-position">
                                        <span class="index">$0</span>
                                    </td>
                                    <td class="mid-position">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="last-position">
                                        <span class="index">$99</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <p class="pickup-info"><b>Free Pickup</b> is available as soon as today More about shipping and pickup</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
