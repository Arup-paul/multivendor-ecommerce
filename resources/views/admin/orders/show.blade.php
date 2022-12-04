@extends('admin.layout.layout', [
     'prev'=> route('admin.orders.index')
])

@section('title', 'Order')

@section('content')
    <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Order Details') }}</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-center flex-column">
                    <ul>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('User Name') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->users->name}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('User Email') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->users->email}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('User Mobile') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->users->mobile}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Payment Gateway') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->payment_gateway}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Shipping Charge') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->shipping_charge}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Coupon Discount') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->users->mobile}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Total Amount') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->grand_total}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Payment Status') }}</div>
                            <div class="font-weight-light"><span></span>
                                @if($order->payment_status ==2)
                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @elseif($order->payment_status ==1)
                                    <span class="badge badge-success">{{ __('Complete') }}</span>
                                @elseif($order->payment_status == 0)
                                    <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                @elseif($order->payment_status == 3)
                                    <span class="badge badge-danger">{{ __('Incomplete') }}</span>
                                @endif
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Order Status') }}</div>
                            <div class="font-weight-light"><span></span>
                                @if($order->order_status ==0)
                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @elseif($order->order_status == 3)
                                    <span class="badge badge-success">{{ __('Complete') }}</span>
                                @elseif($order->order_status == 4)
                                    <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                @elseif($order->order_status == 1)
                                    <span class="badge badge-info">{{ __('Processing') }}</span>
                                @elseif($order->order_status == 2)
                                    <span class="badge badge-info">{{ __('Shipping') }}</span>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Delivery Address') }}</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-center flex-column">
                    <ul>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Name') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->name}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Email') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->email}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Mobile') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->mobile}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Address Type') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->address_type}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Zip Code') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->zip}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Address') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->address}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('City') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->city}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('State') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->state}}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="font-weight-bolder">{{ __('Country') }}</div>
                            <div class="font-weight-light"><span></span>{{$order->deliveryAddress->country}}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Product') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap card-table text-center">
                            <thead>
                            <tr>
                                <th>{{ __('Product Name') }}</th>
                                <th>{{ __('Product Color') }}</th>
                                <th>{{ __('Product Code') }}</th>
                                <th>{{ __('Owner') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Size') }}</th>
                                <th class="text-right"> {{ __('Total') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody class="list font-size-base rowlink" data-link="row">

                            @foreach($order->orderProducts as $item)
                                <tr>
                                    <td>{{$item->product->product_name}}</td>
                                    <td>{{$item->product->product_color}}</td>
                                    <td>{{$item->product->product_code}}</td>
                                    <td>
                                        @if(is_null($item->product->owner))
                                            <a href="">Admin</a>
                                        @else
                                            <a href="{{route('admin.vendor-details',$item->product->owner->id)}}">{{$item->product->owner->name}}</a>
                                        @endif

                                    </td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->size}}</td>
                                    <td>{{$item->total}}</td>
                                    <td>
                                        <a target="_blank" href="{{route('product.details',$item->product->slug)}}">
                                            <button class="btn btn-sm btn-primary">{{ __('View') }}</button>
                                        </a>
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
@endsection

