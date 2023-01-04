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
                            @if($compares->count() > 0)

                            <tbody>
                            <tr class="background-secondary">
                                <th class="text-uppercase">Summary</th>
                                @foreach($compares as $compare)
                                    <td><span class="text-medium">{{$compare->product->product_name}}</span></td>
                                @endforeach


                            </tr>
                            <tr>
                                <td>
                                @foreach($compares as $compare)
                                        <h6>
                                            {{$compare->product->product_name}}
                                        </h6>
                                        <p><b>Brand</b> : {{$compare->product->brand->name}}
                                            , <b>Price</b> :  {{$compare->product->product_price}}
                                        </p>
                                @endforeach

                                </td>

                                @foreach($compares as $compare)
                                <td>
                                    <img src="{{asset($compare->product->product_image)}}" height="120" width="120" alt="">

                                <form action="{{route('cart.add')}}" method="post" class="cartForm">
                                    @csrf
                                    <input type="hidden" name="product_id"  value="{{$compare->product->id}}" class="cart_product_id_{{$compare->product->id}}">
                                    <input type="hidden" name="qty" value="1"   class="cart_product_price_{{$compare->product->id}}">
                                    @if(isset($compare->product->attributes[0]))
                                        <input type="hidden" name="size" value="{{$compare->product->attributes[0]->size}}"  class="cart_product_size_{{$compare->product->id}}">
                                    @else
                                        <input type="hidden" name="size" value="No Size" class="cart_product_size_{{$compare->product->id}}">
                                    @endif

                                    <button type="submit" class="product-button btn btn-warning btn-sm add_to_single_cart" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> To Cart </button>
                                    <a class="product-button btn btn-danger btn-sm   removeCompareItem"  data-id="{{$compare->id}}" data-url="{{route('user.compare.destroy')}}" href="javascript:;"  ><i class="fa fa-trash "></i> </a>
                                </form>
                                </td>
                                @endforeach

                            </tr>

                            <tr>
                                <th>Product Name</th>
                                @foreach($compares as $compare)
                                    <td>{{$compare->product->product_name}}</td>
                                @endforeach

                            </tr>
                            <tr>
                                <th>Color</th>
                                @foreach($compares as $compare)
                                    <td>{{$compare->product->product_color}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>Size</th>
                                @foreach($compares as $compare)
                                    <td>
                                        @foreach($compare->product->attributes as $attribute)
                                            {{$attribute->size}} /
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>Prize</th>
                                @foreach($compares as $compare)
                                    <td>
                                        @foreach($compare->product->attributes as $attribute)
                                            {{$attribute->price}} /
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>Discount</th>
                                @foreach($compares as $compare)
                                    <td>{{$compare->product->product_discount}}</td>
                                @endforeach
                            </tr>


                            <tr>
                                <th>Category</th>
                                @foreach($compares as $compare)
                                    <td>{{$compare->product->category->category_name}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <th>Availability</th>
                                @foreach($compares as $compare)
                                    @if($compare->product->attributes->sum('stock') > 0)
                                       <td> <div class="d-inline text-success">In Stock</div></td>
                                    @else
                                        <td><div class="d-inline text-danger">Out Of Stock</div></td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <th>Description</th>
                                @foreach($compares as $compare)
                                    <td width="35%">{{$compare->product->description}}</td>
                                @endforeach
                            </tr>




                            </tbody>
                            @else
                                <h4 class="text-center">Product Not found</h4>
                                @endif



                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection
