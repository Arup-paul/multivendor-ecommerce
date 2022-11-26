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
            @php
                $total = 0;
                $totalQuantity = 0;
            @endphp
            @if($cartItems->count() > 0)
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
                                <input type="text" name="qty"  value="{{$items->quantity}}" data-max_value="20" data-min_value="1" data-step="1">
                                <a href="#" class="qty-btn btn-up updateCartItems qtyPlus" data-cartid="{{$items->id}}" data-qty="{{$items->quantity}}"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                <a href="#" class="qty-btn btn-down updateCartItems qtyMinus"  data-cartid="{{$items->id}}" data-qty="{{$items->quantity}}" ><i class="fa fa-caret-down" aria-hidden="true"></i></a>
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
                            <a href="#" class="remove removeCartItem" data-cartid="{{$items->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                    </td>
                </tr>

                @php
                    if($discount != 0){
                        $total += $discount * $items->quantity;
                    }else{
                       $total += $items->product->product_price * $items->quantity;
                    }
                    $totalQuantity += $items->quantity;
                @endphp
            @endforeach
            @endif

                <tr class="cart_item wrap-buttons">
                    <td class="wrap-btn-control" colspan="5">
                        <a class="btn btn-update"  href="" >Back To Shop</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

</div>
<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="shpcart-subtotal-block">
        <div class="subtotal-line">
            <b class="stt-name">Subtotal <span class="sub">({{$totalQuantity}} @if($totalQuantity =1) Item) @else Items) @endif  </span></b>
            <span class="stt-price">$ {{$total}}</span>
        </div>
        <div class="subtotal-line">
            <b class="stt-name">Coupon Discount</b>
            <span class="stt-price">$0.00</span>
        </div>


            <div class="subtotal-line">
                <form id="ApplyCoupon" method="post" action="javascript:;"  @auth user="1"   @endauth >
                    @csrf
                    <b class="stt-name">Coupon Code</b>
                    <div class="d-flex">
                        <input type="text" id="coupon_code" name="coupon_code" required placeholder="Enter Code" class="form-control">
                        <button type="submit" class="btn checkout">Apply</button>
                    </div>
               </form>
            </div>


        <div class="btn-checkout">
            <a href="#" class="btn checkout">Check out</a>
        </div>
          </div>
</div>

@push('frontend_scripts')
    <script>
        $(document).on('submit','#ApplyCoupon',function (e){
             var user = $(this).attr("user");
             if(user != 1 ){
                 Notify('error','Please Login First' );
                 return false;
             }
             var code = $("#coupon_code").val();
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 type:'POST',
                 data:{code:code},
                 url:"{{route('apply.coupon')}}",
                 success:function (res){
                      if(res.invalid_coupon){
                          Notify('error',res.invalid_coupon );
                      }
                 },error:function (e){
                     Notify('error','Something went wrong!' );
                 }
             })

          })
    </script>
@endpush

