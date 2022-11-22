@extends('frontend.layouts.layouts')
@section('content')

    <div class="login-background">

    <div class="container">

        <div class="row">

            <!--Form Sign In-->
            <div class="col-md-6 col-md-offset-3  col-sm-12 col-xs-12">
                <div class="signin-container  panel ">
                    <div class="panel-body">
                    <div class="login-header ">
                        <h3>Create your Account</h3>
                        <small>Already Member? <a href="{{route('login')}}" class=" "> Sign In </a>here</small>
                    </div>

                    <form action="{{route('register')}}" name="frm-login" class="ajaxform" method="post">
                        @csrf
                        <p class="form-row">
                            <label for="fid-name">Name:<span class="requite">*</span></label>
                            <input type="text" id="fid-name" name="name" value="" class="txt-input">
                        </p>
                        <p class="form-row">
                            <label for="mobile">Mobile Number:<span class="requite">*</span></label>
                            <input type="text" id="mobile" name="mobile" value="" class="txt-input">
                        </p>
                        <p class="form-row">
                            <label for="email">Email Address:<span class="requite">*</span></label>
                            <input type="email" id="email" name="email" value="" class="txt-input">
                        </p>
                        <p class="form-row">
                            <label for="pass">Password:<span class="requite">*</span></label>
                            <input type="password" id="pass" name="password" value="" class="txt-input">
                        </p>
                        <p class="form-row">
                            <label for="confirm_password">Confirm Password:<span class="requite">*</span></label>
                            <input type="password" id="confirm_password" name="password_confirmation" value="" class="txt-input">
                        </p>
                        <p class="form-row wrap-btn">
                            <button class="btn btn-submit btn-bold basicbtn" type="submit">Sign Up</button>
                        </p>

                    </form>
                    </div>
                    </div>
                </div>



        </div>

        </div>

    </div>
@endsection
