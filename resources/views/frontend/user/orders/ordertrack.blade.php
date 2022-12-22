@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
        <div class="container  ">
            <div class="row">



                <!--checkout progress box-->
                <div class="col-12">

                    <div class="signin-container user-container  panel  ">
                        <div class="panel-body ">
                            <div class="row  ">
                                <div class="col-sm-6 col-sm-offset-2">
                                    <input type="text" class="form-control" name="order_id">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary btn-block mt-0" id="submit_number"   type="submit"><span>Track Now</span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

@endsection
