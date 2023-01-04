@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
    <div class="container container-xxl ">
        <div class="row">



            <!--checkout progress box-->
            <div class=" col-sm-12">

                <div class="signin-container user-container  panel  ">
                    <div class="panel-body wishlist-table">
                        <table class="table table-bordered table-wishlist">

                            <tbody>
                            <tr class="background-secondary">
                                <th class="text-uppercase">Summary</th>
                                <td><span class="text-medium">Men Shirt Custom Shirts Hot Sale Men Women Polyester Cotton Long Sleeve Casual pro</span></td>

                                <td><span class="text-medium">UMIDIGI A9 Pro Android Mobile Phone 4g 48MP Quad Camera 6.3" FHD+ Full Screen 6GB RAM</span></td>

                            </tr>
                            <tr>
                                <td>
                                    <h6>
                                        Men Shirt Custom Shirts Hot Sale Men Women Polyester Cotton Long Sleeve Casual pro
                                    </h6>
                                    <p><b>Brand</b> :
                                        , <b>Price</b> :  $1,362.81
                                    </p>

                                    <hr>
                                    <h6 class="mt-2">
                                        UMIDIGI A9 Pro Android Mobile Phone 4g 48MP Quad Camera 6.3" FHD+ Full Screen 6GB RAM
                                    </h6>
                                    <p><b>Brand</b> :
                                        , <b>Price</b> :  $1,573.03</p>
                                </td>

                                <td>

                                <form action="{{route('cart.add')}}" method="post" class="cartForm">
                                    @csrf

{{--                                    <input type="hidden" name="product_id" value="{{$wishlist->product->id}}" class="cart_product_id_{{$wishlist->product->id}}">--}}
{{--                                    <input type="hidden" name="qty" value="1"   class="cart_product_price_{{$wishlist->product->id}}">--}}
{{--                                    @if(isset($wishlist->product->attributes[0]))--}}
{{--                                        <input type="hidden" name="size" value="{{$wishlist->product->attributes[0]->size}}"  class="cart_product_size_{{$wishlist->product->id}}">--}}
{{--                                    @else--}}
{{--                                        <input type="hidden"  value="No Size" class="cart_product_size_{{$wishlist->product->id}}">--}}
{{--                                    @endif--}}
{{--                                    data-wishlistid="{{$wishlist->id}}"--}}
                                    <button type="submit" class="product-button btn btn-warning btn-sm add_to_single_cart" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> To Cart </button>
                                    <a class="product-button btn btn-danger btn-sm   removeWishlistItem" data-url="{{route('user.wishlist.destroy')}}" href="javascript:;"  ><i class="fa fa-trash "></i> </a>
                                </form>
                                </td>
                                <td>
                                </td>
                            </tr>

                            <tr>
                                <th>Product Name</th>
                                <td>
                                    Velvet elegant sleeveless evening dress
                                </td>
                                <td>
                                    Velvet elegant sleeveless evening dress
                                </td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td>
                                    Polyester / Spandex
                                </td>
                                <td>
                                    Polyester / Spandex
                                </td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td>
                                    Polyester
                                </td>
                                <td>
                                    Polyester
                                </td>
                            </tr>
                            <tr>
                                <th>Prize</th>
                                <td>
                                    Fleece
                                </td>
                                <td>
                                    Fleece
                                </td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>
                                    Plain dyed
                                </td>
                                <td>
                                    Plain dyed
                                </td>
                            </tr>
                            <tr>
                                <th>Decoration</th>
                                <td>
                                    Sequins
                                </td>
                                <td>
                                    Sequins
                                </td>
                            </tr>

                            <tr>
                                <th>Category</th>
                                <td>
                                    Velvet elegant sleeveless evening dress
                                </td>
                                <td>
                                    Velvet elegant sleeveless evening dress
                                </td>
                            </tr>
                            <tr>
                                <th>Availability</th>
                                <td>
                                    Velvet elegant sleeveless evening dress
                                </td>
                                <td>
                                    Velvet elegant sleeveless evening dress
                                </td>
                            </tr>




                            </tbody>



                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection
