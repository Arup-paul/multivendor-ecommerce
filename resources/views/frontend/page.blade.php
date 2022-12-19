
@extends('frontend.layouts.layouts')
@section('content')


    <div class="page-contain about-us mt-5 pt-5">
        <div id="main-content" class="main-content pt-5 mt-5">
            <div class="welcome-us-block pt-5">
                <div class="container container-xxl">
                    <div class="panel">
                    <div class="panel-body">
                    <h4 class="title">{{ucwords($page->title)}}</h4>
                    <div class="text-wraper">
                        <p class="text-info">{!! $page->description !!}</p>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
    <style>
        .page-contain.about-us {
            background: #e7e8ec;
        }
        .page-contain.about-us .welcome-us-block {
            padding: 50px 0;
        }
        .page-contain.about-us .welcome-us-block .title {
            font-weight: 600;
            color: #000;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }
        .page-contain.about-us .welcome-us-block .text-wraper {
            text-align: center;
        }
        .page-contain.about-us .welcome-us-block .text-wraper .text-info {
            font-size: 16px;
            color: #000;
            line-height: 30px;
        }
    </style>
@endsection



