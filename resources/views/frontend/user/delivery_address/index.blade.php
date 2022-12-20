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
                        <h3 class="title-box">Delivery Addresses <a href="{{route('user.delivery-address.create')}}" class="add_delivery">Add new </a></h3>
                        <div class="row">
                            @foreach($deliveryAddress as $address)
                            <div class="col-md-6 col-12">
                                <div class="delivery_address">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <label for="address-{{$address->id}}">
                                                <h6><span>Name: </span>{{$address->name}}</h6>
                                                <h6><span>Mobile: </span>{{$address->mobile}}</h6>
                                                <h6><span>Email: </span>{{$address->email}}</h6>
                                                <h6><span>Address Type: </span>{{$address->address_type}}</h6>
                                                <h6><span>Zip Code: </span>{{$address->zip}}</h6>
                                                <h6><span>Address: </span>{{$address->address}},{{$address->city}},{{$address->state}},{{$address->country}}</h6>
                                            </label>
                                        </div>
                                    <div class="col-md-3">
                                        <a href="{{route('user.delivery-address.edit',$address->id)}}">Edit</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
    </div>

@endsection
