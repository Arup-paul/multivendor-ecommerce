@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
        <div class="container  ">
            <div class="row">



                <!--checkout progress box-->
                <div class="col-12">

                    <div class="signin-container user-container  panel  ">
                        <div class="panel-body min-height-346px ">
                            <div class="row p-50 ">
                                <div class="col-sm-6 col-sm-offset-2">
                                    <input type="text" class="form-control h-40" name="order_id">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary bg-main order-track-btn btn-block mt-0 h-40" id="submit_number"   type="submit"><span>Track Now</span></button>
                                </div>
                            </div>
                            <div class="row py-4">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="text-center pt-20 ">
                                        <div class="  p-5">
                                            <p><strong>Delivered</strong>Sunday 21 january 2022, Product Delivered</p>
                                            <p><strong>Delivered</strong>Sunday 21 january 2022, Product Delivered</p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

@endsection
