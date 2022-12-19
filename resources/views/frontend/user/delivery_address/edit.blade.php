@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
    <div class="container container-xxl">
        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
               @include('frontend.user.sidebar')
            </div>


            <!--checkout progress box-->
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 ">

                <div class="signin-container  user-container panel  ">
                    <div class="panel-body ">
                        <h4>Update Delivery Address</h4>
                        <form action="{{route('user.delivery-address.update',$deliveryAddress->id)}}" name="frm-login" class="ajaxform" method="post">
                            @csrf
                            @method('put')
                            <p class="form-row">
                                <label for="fid-name">Name:<span class="required">*</span></label>
                                <input type="text" id="fid-name" name="name" value="{{$deliveryAddress->name}}" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="mobile">Mobile Number:<span class="required">*</span></label>
                                <input type="text" id="mobile" name="mobile"  value="{{$deliveryAddress->mobile}}" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="email">Email Address:<span class="required">*</span></label>
                                <input type="email" id="email" name="email"  value="{{$deliveryAddress->email}}" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="address">Full Address:<span class="required">*</span></label>
                                <input type="text" id="address" name="address"  value="{{$deliveryAddress->address}}" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="city">City:<span class="required">*</span></label>
                                <input type="text" id="city" name="city"  value="{{$deliveryAddress->city}}" class="txt-input">
                            </p>

                            <p class="form-row">
                                <label for="state">State:<span class="required">*</span></label>
                                <input type="text" id="state" name="state"  value="{{$deliveryAddress->state}}" class="txt-input">
                            </p>

                            <p class="form-row">
                                <label for="country">Country:<span class="required">*</span></label>
                                <select name="country" class="form-control txt-input" id="country">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option @selected($deliveryAddress->country == $country->country) value="{{$country->country}}">{{$country->country}}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p class="form-row">
                                <label for="zip">Zip Code:<span class="required">*</span></label>
                                <input type="text" id="zip" name="zip"  value="{{$deliveryAddress->zip}}" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="address_type">Address Type:<span class="required">*</span></label>
                                <select name="address_type" class="form-control" id="address_type">
                                    <option value="">Select Address Type</option>
                                    <option value="home" @selected($deliveryAddress->address_type == 'home')>Home</option>
                                    <option value="office" @selected($deliveryAddress->address_type == 'office')>Office</option>
                                </select>
                            </p>

                            <p class="form-row wrap-btn">
                                <button class="btn btn-submit btn-bold basic-btn" type="submit">Update</button>
                            </p>

                        </form>
                    </div>
                </div>

            </div>


        </div>
    </div>

@endsection
