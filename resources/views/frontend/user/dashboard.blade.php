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
                        <h4>Dashboard</h4>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection
