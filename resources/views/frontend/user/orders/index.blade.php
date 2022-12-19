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
                    <div class="panel-body ">
                        <h3>Orders</h3>
                        <table>
                            <thead>
                              <tr>
                                  <th>Order Id</th>
{{--                                  <th>Order Product</th>--}}
                                  <th>Grand Total</th>
                                  <th>Pay With</th>
                                  <th>Order Created At</th>
                                  <th>Details</th>
                              </tr>
                            </thead>

                            <tbody>
                            @foreach($orders as $order)
                              <tr>
                                  <td>{{$order->id}}</td>
{{--                                  <td>--}}
{{--                                      @foreach($order->orderProducts as $item)--}}
{{--                                        <a href="{{route('product.details',$item->product->slug)}}"> {{$item->product->product_name}}</a>--}}
{{--                                          <p>Quantity:{{$item->qty}}</p>--}}
{{--                                          <p>Size:{{$item->size}}</p>--}}
{{--                                      @endforeach--}}
{{--                                  </td>--}}
                                  <td>${{$order->grand_total}}</td>
                                  <td>{{$order->payment_method === 'COD' ? 'Cash On Delivery' : 'prepaid'}}</td>
                                  <td>{{$order->created_at->format('d M Y')}}</td>
                                  <td>
                                      <a href="{{route('user.orders.details',$order->id)}}" title="View" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                  </td>
                              </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection
