@extends('frontend.layouts.layouts')
@section('content')

    <div class="container sm-margin-top-37px">
        <div class="order-completed-area-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center">
                            <img src="{{asset('frontend/img/check-icon.svg')}}" alt="icon">
                            <h2 class="page-status-title">Your order is Completed!</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="order-data">
                            <table>
                                <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>#{{$order->id}}</td>
                                    <td>{{$order->created_at->format('d/m/Y')}}</td>
                                    <td>${{$order->grand_total}}</td>
                                    <td>
                                        @if($order->payment_gateway == 'COD')
                                            Cash On Delivery
                                        @else
                                            {{ucfirst($order->payment_gateway)}}
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="btn-wrapper text-right">
                            <a class="btn btn-update new-btn"  href="{{route('shop')}}" >Back To Shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>

@endsection

