@extends('admin.layout.layout', [
    'prev'=> route('admin.orders.index')
])

@section('title','Orders')

@section('content')
    <section class="section">
        <div class="row mb-none-30">
            <div class="col-lg-8 offset-lg-2 mb-30">
                <div class="card b-radius-10 overflow-hidden box-shadow1">
                    <div class="card-body">
                        <h5 class="mb-20 text-muted">{{ __('Orders Via') }} {{$order->payment_method}}</h5>
                        <div class="p-3 bg-white">
                            <img src="{{asset('frontend/img/cash-on-delivery.jpg')}}" alt="{{$order->payment_method}}" width="150" height="150" class="img-fluid circle">
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __('Date') }} <span class="font-weight-bold">{{ date('d M y', strtotime($order->created_at)) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __('Shipping Charge') }} <span class="font-weight-bold">{{ $order->shipping_charge  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __('Coupon Discount ') }} <span class="font-weight-bold">{{ $order->coupon_discount  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __('Total Amount ') }} <span class="font-weight-bold">{{ $order->grand_total  }}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __('Username') }}
                                <span class="font-weight-bold">
                                      <a href=""><span>@</span>{{$order->users->name}}</a>
                                </span>
                            </li>
                            <form method="post" class="ajaxform"
                                  action="{{route('admin.orders.payment-status',$order->id)}}">
                                @csrf
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ __('Payment Status') }} <span class="font-weight-bold">
                                    <select class="form-control" name="payment_status">
                                       <option value="1" {{$order->payment_status == 1 ? 'selected' : ''}}>{{ __('Complete') }}</option>
                                       <option value="0" {{$order->payment_status == 0 ? 'selected' : ''}}>{{ __('Failed') }}</option>
                                       <option value="2" {{$order->payment_status == 2 ? 'selected' : ''}}>{{ __('Pending') }}</option>
                                       <option value="2" {{$order->payment_status == 3 ? 'selected' : ''}}>{{ __('Incomplete') }}</option>
                                    </select>
                                    </span>
                                    <button class="btn btn-primary   basicbtn" type="submit">{{ __('Update') }}</button>
                                </li>
                            </form>

                            <form method="post" class="ajaxform"
                                  action="{{route('admin.orders.order-status',$order->id)}}">
                                @csrf
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ __('Order Status') }} <span class="font-weight-bold">
                                    <select class="form-control order_status" name="order_status">
                                       <option value="3" {{$order->order_status == 3 ? 'selected' : ''}}>{{ __('Complete') }}</option>
                                       <option value="1" {{$order->order_status == 1 ? 'selected' : ''}}>{{ __('Processing') }}</option>
                                       <option value="0" {{$order->order_status == 0 ? 'selected' : ''}}>{{ __('Pending') }}</option>
                                       <option value="2" {{$order->order_status == 2 ? 'selected' : ''}}>{{ __('Shipping') }}</option>
                                       <option value="4" {{$order->order_status == 4 ? 'selected' : ''}}>{{ __('Cancel') }}</option>
                                       <option value="5" {{$order->order_status == 5 ? 'selected' : ''}}>{{ __('Delivered') }}</option>
                                    </select>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center " >
                                    <input type="text" name="courier_name" value="{{$order->courier_name}}" placeholder="Enter Courier Name" class="form-control @if(empty($order->courier_name)) courierName @endif">
                                    <input type="text" name="tracking_number" value="{{$order->tracking_number}}" placeholder="Enter Tracking Number" class="form-control @if(empty($order->courier_name)) trackingNumber @endif ">
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary col-12   basicbtn" type="submit">{{ __('Update') }}</button>
                                </li>
                            </form>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="row mb-none-30">
            <div class="col-lg-8 offset-lg-2 mb-30">
                <div class="card b-radius-10 overflow-hidden box-shadow1">
                    <div class="card-body">
                        <h5 class="mb-20 text-muted">{{ __('Orders Status Log') }}  </h5>

                        <ul class="list-group">
                            @foreach($orderLogs as $log)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @if($log->status == 0)
                                     {{ __('Pending') }}
                                @elseif($log->status == 3)
                                     {{ __('Complete') }}
                                @elseif($log->status == 4)
                                      {{ __('Cancel for ') }}   {{$log->reason ?? 'Admin'}} {{$log->additional_reason ?? ''}}
                                @elseif($log->status == 1)
                                      {{ __('Processing') }}
                                @elseif($log->status == 2)
                                    {{ __('Shipping') }}
                                @endif<span class="font-weight-bold">{{ date('d M Y h:i A', strtotime($log->created_at)) }}</span>
                            </li>
                          @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('script')
    <script>
        $('.courierName').hide();
        $('.trackingNumber').hide();

        $(".order_status").change(function () {
            var status = $(this).val();
            if (status == 2) {
                $('.courierName').show();
                $('.trackingNumber').show();
            } else {
                $('.courierName').hide();
                $('.trackingNumber').hide();
            }
        });
    </script>
@endpush
