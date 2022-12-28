@extends('frontend.layouts.layouts')

@section('content')
    <div class="page-contain blog-page">
        <div class="container container-xxl">
            <!-- Main content -->
            <div id="main-content" class="main-content">

                <div class="row">

                    <ul class="posts-list main-post-list">


                        @foreach($blogs as $blog)
                        <li class="post-elem col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="post-item effect-04 style-bottom-info">
                                <div class="thumbnail">
                                    <a href="#" class="link-to-post"><img src="assets/images/our-blog/post-thumb-01.jpg" width="370" height="270" alt=""></a>
                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">Ashwagandha: #1 Herb Anxiety?</a></h4>
                                    <p class="post-archive"><b class="post-cat">ORGANIC</b><span class="post-date"> / 20 Nov, 2018</span><span class="author">Posted By: Braum J.Teran</span></p>
                                    <p class="excerpt">Did you know that red-staining foods are excellent lymph-movers? In fact, many plants that were historically used as dyes...</p>
                                    <div class="group-buttons">
                                        <a href="#" class="btn readmore">read more</a>
                                        <a href="#" class="btn count-number liked"><i class="biolife-icon icon-heart-1"></i><span class="number">20</span></a>
                                        <a href="#" class="btn count-number commented"><i class="biolife-icon icon-conversation"></i><span class="number">06</span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach


                    </ul>

                </div>

                <!--Panigation Block-->
                <div class="biolife-panigations-block ">
                    <ul class="panigation-contain">
                        <li><span class="current-page">1</span></li>
                        <li><a href="#" class="link-page">2</a></li>
                        <li><a href="#" class="link-page">3</a></li>
                        <li><span class="sep">....</span></li>
                        <li><a href="#" class="link-page">20</a></li>
                        <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

@endsection
