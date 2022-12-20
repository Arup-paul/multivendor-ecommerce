@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
    <div class="container container-xxl ">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                @include('frontend.user.sidebar')
            </div>


            <!--checkout progress box-->
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">

                <div class="signin-container user-container  panel  ">
                    <div class="panel-body wishlist-table">
                        <table class="table table-wishlist mb-0">
                            <thead>
                            <tr>
                                <th>Wishlist Product</th>
                                @if($wishlists->count() > 0)
                                <th class="text-center"><a class="btn btn-sm btn-warning removeWishlistALlItem" data-url="{{route('user.wishlist.mass-destroy')}}" href="javascript:;" ><span>Clear Wishlist</span></a></th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($wishlists as $wishlist)

                            <tr>
                                <td>
                                    <div class="product-item"><a class="product-thumb" href="{{route('product.details',$wishlist->product->slug)}}"><img src="{{asset($wishlist->product->product_image)}}" alt="Product"></a>
                                        <div class="product-info pull-left">
                                            <h4 class="product-title  "><a href="{{route('product.details',$wishlist->product->slug)}}">{{$wishlist->product->product_name}} </a></h4>
                                             <div class="pull-left">
                                                 <div class="text-lg mb-1  ">${{$wishlist->product->product_price}}</div>
                                                 <div class="text-sm ">Availability:
                                                     @if($wishlist->product->attributes->sum('stock') > 0)
                                                         <div class="d-inline text-success">In Stock</div>
                                                     @else
                                                         <div class="d-inline text-danger">Out Of Stock</div>
                                                     @endif

                                                 </div>
                                             </div>
                                        </div>

                                    </div>
                                </td>
                                <td class="text-center wishlist-action">
                                    <form action="{{route('cart.add')}}" method="post" class="cartForm">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{$wishlist->product->id}}" class="cart_product_id_{{$wishlist->product->id}}">
                                        <input type="hidden" name="qty" value="1"   class="cart_product_price_{{$wishlist->product->id}}">
                                        @if(isset($wishlist->product->attributes[0]))
                                            <input type="hidden" name="size" value="{{$wishlist->product->attributes[0]->size}}"  class="cart_product_size_{{$wishlist->product->id}}">
                                        @else
                                            <input type="hidden"  value="No Size" class="cart_product_size_{{$wishlist->product->id}}">
                                        @endif
                                      <button type="submit" class="product-button btn btn-warning btn-sm add_to_single_cart" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> To Cart </button>
                                       <a class="product-button btn btn-danger btn-sm   removeWishlistItem" data-wishlistid="{{$wishlist->id}}" data-url="{{route('user.wishlist.destroy')}}" href="javascript:;"  ><i class="fa fa-trash "></i> </a>
                                    </form>

                                </td>
                            </tr>
                            @empty
                                <td>Product Not Found</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection
