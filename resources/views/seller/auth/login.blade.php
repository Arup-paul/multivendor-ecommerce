@extends('frontend.layouts.layouts')
@section('content')

    <div class="login-background">

    <div class="container">

        <div class="row">

            <!--Form Sign In-->
            <div class="col-md-6 col-md-offset-3  col-sm-12 col-xs-12">

                <div class="signin-container panel">
                    <div class="panel-body">
                    <div class="login-header ">
                        <h3>Login</h3>
                        <small>New member? <a href="{{route('seller.register')}}" class=" "> Register </a>here</small>
                    </div>

                    <form action="{{route('seller.login')}}" name="frm-login" class="ajaxform" method="post">
                        @csrf
                        <p class="form-row">
                            <label for="fid-name">Email Address:<span class="requite">*</span></label>
                            <input type="email" id="fid-name" name="email" value="" class="txt-input">
                        </p>
                        <p class="form-row">
                            <label for="fid-pass">Password:<span class="requite">*</span></label>
                            <input type="password" id="fid-pass" name="password" value="" class="txt-input">
                        </p>
                        <p class="form-row wrap-btn">
                            <button class="btn btn-submit btn-bold basic-btn" type="submit">sign in</button>
                            <a href="#" class="link-to-help">Forgot your password</a>
                        </p>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
