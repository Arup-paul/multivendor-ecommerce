@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
    <div class="container ">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                @include('frontend.user.sidebar')
            </div>


            <!--checkout progress box-->
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">

                <div class="signin-container user-container  panel  ">
                    <div class="panel-body ">
                        <h4>Add New Delivery Address</h4>
                        <form action="{{route('user.delivery-address.store')}}" name="frm-login" class="ajaxform_with_reset" method="post">
                            @csrf
                            <p class="form-row">
                                <label for="fid-name">Name:<span class="required">*</span></label>
                                <input type="text" id="fid-name" name="name" value="" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="mobile">Mobile Number:<span class="required">*</span></label>
                                <input type="text" id="mobile" name="mobile" value="" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="email">Email Address:<span class="required">*</span></label>
                                <input type="email" id="email" name="email" value="" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="address">Full Address:<span class="required">*</span></label>
                                <input type="text" id="address" name="address" value="" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="city">City:<span class="required">*</span></label>
                                <input type="text" id="city" name="city" value="" class="txt-input">
                            </p>

                            <p class="form-row">
                                <label for="state">State:<span class="required">*</span></label>
                                <input type="text" id="state" name="state" value="" class="txt-input">
                            </p>

                            <p class="form-row">
                                <label for="country">Country:<span class="required">*</span></label>
                                <input type="text" id="country" name="country" value="" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="zip">Zip Code:<span class="required">*</span></label>
                                <input type="text" id="zip" name="zip" value="" class="txt-input">
                            </p>
                            <p class="form-row">
                                <label for="address">Full Address:<span class="required">*</span></label>
                                <select name="address_type" class="form-control" id="">
                                    <option value="">Select Address Type</option>
                                    <option value="home">Home</option>
                                    <option value="office">Office</option>
                                </select>
                            </p>

                            <p class="form-row wrap-btn">
                                <button class="btn btn-submit btn-bold basicbtn" type="submit">Add New</button>
                            </p>

                        </form>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection
