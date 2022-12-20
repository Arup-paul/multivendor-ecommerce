@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
    <div class="container container-xxl">
        <div class="row">
            <div class="col-lg-3 col-mm-3 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                @include('frontend.user.sidebar')
            </div>


            <!--checkout progress box-->
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">

                <div class="signin-container user-container  panel  ">
                    <div class="panel-body ">
                        <h4>Order Cancel Reason</h4>
                        <form action="{{route('user.orders.cancel',$id)}}" name="frm-login" class="ajaxform" method="post">
                            @csrf

                             <div class="row">
                                 <div class="col-md-6">
                                     <p class="form-row">
                                         <label for="address_type">Reason<span class="required">*</span></label>
                                         <select name="reason" class="form-control">
                                             <option value="">Select Reason</option>
                                             <option value="Change My Mind">Change My Mind</option>
                                             <option value="Product Excance">Product Excance</option>
                                             <option value="Mistake By Order">Mistake By Order</option>
                                             <option value="Others">Others</option>
                                         </select>
                                     </p>
                                 </div>
                                 <div class="col-md-6">
                                     <p class="form-row">
                                         <label for="address_type">Additional Reason<span class="required">*</span></label>
                                         <textarea class="form-control" name="additional_reason" id="" cols="10" rows="5"></textarea>

                                     </p>
                                 </div>

                             </div>

                            <p class="form-row wrap-btn">
                                <button class="btn btn-submit btn-bold basicbtn" type="submit">Submit</button>
                            </p>

                        </form>

                        <div class="col-md-12">
                            <div class="panel-body panel">
                                <h4>Product Details</h4>
                                <table>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Size</th>
                                        <th>Product Color</th>
                                        <th>Product Quantity</th>
                                    </tr>
                                    @foreach($order->orderProducts as $item)
                                        <tr>
                                            <td>
                                                <a href="{{route('product.details',$item->product->slug)}}"> <img src="{{asset($item->product->product_image)}}" width="80" height="80" alt="{{$item->product->product_name}}"></a>
                                            </td>
                                            <td>{{$item->product->product_name}}</td>
                                            <td>{{$item->product->product_code}}</td>
                                            <td>{{$item->size}}</td>
                                            <td>{{$item->product->product_color}}</td>
                                            <td>{{$item->qty}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection
