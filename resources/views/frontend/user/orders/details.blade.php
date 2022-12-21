@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
    <div class="container container-xxl">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                @include('frontend.user.sidebar')
            </div>


            <!--checkout progress box-->
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                <div class="signin-container user-container    ">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="panel-body panel">
                               <h4 class="pull-left">Order #{{$order->id}} Details</h4>
                                @if($order->order_status == '0')
                                   <a  href="{{route('user.orders.cancel',$order->id)}}" class="btn btn-danger pull-right">Cancel Order</a>
                                @endif
                              @if($order->order_status == 5)
                                  <a  href="{{route('user.orders.return',$order->id)}}" class="btn btn-danger pull-right">Return Order</a>
                              @endif
                              <table>

                                  <tr>
                                      <th>Order Date</th>
                                      <td>{{$order->created_at->format('d M Y')}}</td>
                                  </tr>
                                  <tr>
                                      <th>Order Status</th>
                                      <td>  @if($order->order_status ==0)
                                              <span class="text text-warning">{{ __('Pending') }}</span>
                                          @elseif($order->order_status == 3)
                                              <span class="text text-success">{{ __('Complete') }}</span>
                                          @elseif($order->order_status == 4)
                                              <span class="text text-danger">{{ __('Cancel') }}</span>
                                          @elseif($order->order_status == 1)
                                              <span class="text text-info">{{ __('Processing') }}</span>
                                          @elseif($order->order_status == 2)
                                              <span class="text text-info">{{ __('Shipping') }}</span>
                                          @elseif($order->order_status == 5)
                                              <span class="text text-info">{{ __('Delivered') }}</span>
                                          @endif
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Payment Status</th>
                                      <td>
                                          @if($order->payment_status ==2)
                                              <span class="text text-warning">{{ __('Pending') }}</span>
                                          @elseif($order->payment_status ==1)
                                              <span class="text text-success">{{ __('Complete') }}</span>
                                          @elseif($order->payment_status == 0)
                                              <span class="text text-danger">{{ __('Cancel') }}</span>
                                          @elseif($order->payment_status == 3)
                                              <span class="text text-danger">{{ __('Incomplete') }}</span>
                                          @endif
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Order Total</th>
                                      <td>${{$order->grand_total}}</td>
                                  </tr>
                                  <tr>
                                      <th>Shipping Charge</th>
                                      <td>${{$order->shipping_charge}}</td>
                                  </tr>
                                  <tr>
                                      <th>Coupon Code</th>
                                      <td>{{$order->coupon_code}}</td>
                                  </tr>
                                  <tr>
                                      <th>Coupon Amount</th>
                                      <td>${{$order->coupon_amount}}</td>
                                  </tr>
                                  <tr>
                                      <th>Payment Method</th>
                                      <td>{{$order->payment_method === 'COD' ? 'Cash On Delivery' : 'prepaid'}}</td>
                                  </tr>
                                  @if(isset($order->courier_name))
                                      <tr>
                                          <th>Courier Name</th>
                                          <td>{{$order->courier_name}}</td>
                                      </tr>
                                  @endif
                                  @if(isset($order->tracking_number))
                                      <tr>
                                          <th>Tracking Number</th>
                                          <td>{{$order->tracking_number}}</td>
                                      </tr>
                                  @endif



                              </table>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="panel-body panel">
                              <h4>Delivery Address</h4>
                              <table>

                                  <tr>
                                      <th>Name</th>
                                      <td>{{$order->deliveryAddress->name}}</td>
                                  </tr>
                                  <tr>
                                      <th>Email</th>
                                      <td>{{$order->deliveryAddress->email}}</td>
                                  </tr>
                                  <tr>
                                      <th>Mobile</th>
                                      <td>{{$order->deliveryAddress->mobile}}</td>
                                  </tr>
                                  <tr>
                                      <th>Full Address</th>
                                      <td>Zip Code: {{$order->deliveryAddress->zip}} , {{$order->deliveryAddress->address}},{{$order->deliveryAddress->state}},{{$order->deliveryAddress->city}},{{$order->deliveryAddress->country}}</td>
                                  </tr>
                                  <tr>
                                      <th>Address Type</th>
                                      <td>{{$order->deliveryAddress->address_type}}</td>
                                  </tr>

                              </table>
                          </div>
                      </div>

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
                                        <th>Item Status</th>
                                    </tr>
                                    @foreach($order->orderProducts as $item)
                                        <tr>
                                            <td>
                                                <a href="{{route('product.details',$item->product->slug)}}"> <img src="{{asset($item->product->product_image)}}" width="150" height="150" alt="{{$item->product->product_name}}"></a>
                                            </td>
                                            <td>{{$item->product->product_name}}</td>
                                            <td>{{$item->product->product_code}}</td>
                                            <td>{{$item->size}}</td>
                                            <td>{{$item->product->product_color}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>{{$item->item_status}}</td>
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
