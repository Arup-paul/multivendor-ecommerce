@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
        <div class="container  ">
            <div class="row">



                <!--checkout progress box-->
                <div class="col-12">

                    <div class="signin-container user-container  panel  ">
                        <div class="panel-body min-height-346px ">
                            <form action="{{route('order.track')}}" method="post">
                                @csrf
                            <div class="row p-50 ">
                                <div class="col-sm-6 col-sm-offset-2">
                                    <input type="text" class="form-control h-40" name="track_id">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary bg-main order-track-btn btn-block mt-0 h-40" id="submit_number"   type="submit"><span><i class="fa fa-map-marker"></i> Track Now</span></button>
                                </div>
                            </div>
                            </form>
                            @isset($orderTrack)
                            <div class="row py-4">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="text-center pt-20 ">
                                        <div class="  p-5">
                                            @foreach($orderTrack as $order)
                                                <p>
                                                  {{ date('d M Y h:i A', strtotime($order->created_at)) }} , Your Product
                                                        @if($order->status == 0)
                                                        <strong class="text text-primary"> Pending </strong> for Approval
                                                        @elseif($order->status == 3)
                                                        Order <strong class="text text-primary">  Complete</strong>
                                                        @elseif($order->status == 4)
                                                           Order is <strong class="text text-danger">  Cancel</strong>
                                                        @elseif($order->status == 1)
                                                        r <strong class="text text-primary">Processing</strong> For  Delivery
                                                        @elseif($order->status == 2)
                                                         <strong class="text text-primary">Shipping</strong> For  Delivery
                                                        @elseif($order->status == 5)
                                                        Order is <strong class="text text-success">Delivered</strong>
                                                        @endif
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endisset
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

@endsection
