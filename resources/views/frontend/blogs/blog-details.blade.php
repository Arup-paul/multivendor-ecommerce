@extends('frontend.layouts.layouts')

@section('content')
    <div class="page-contain blog-page left-sidebar">
        <div class="container">
            <div class="row">

                <!-- Main content -->
                <div id="main-content" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">

                    <!--Single Post Contain-->
                    <div class="single-post-contain">

                        <div class="post-head">
                            <div class="thumbnail">
                                <figure><img src="{{$blog->image}}" width="870" height="635" alt=""></figure>
                            </div>
                            <h2 class="post-name">{{$blog->title ?? null}}</h2>
                            <p class="post-archive"><span class="post-date">{{formatted_date($blog->created_at)}}</span><span class="author">Posted By: Admin</span></p>
                        </div>

                        <div class="post-content">
                            <p>{!! $blog->description ?? null !!}</p>

                        </div>

                    </div>


                </div>

                <!-- Sidebar -->
                <aside id="sidebar" class="sidebar blog-sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">

                    <div class="biolife-mobile-panels">
                        <span class="biolife-current-panel-title">Sidebar</span>
                        <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">&times;</a>
                    </div>

                    <div class="sidebar-contain">

                        <!--Search Widget-->
                        <div class="widget search-widget">
                            <div class="wgt-content">
                                <form action="{{route('blogs')}}" name="frm-search" method="get" class="frm-search">
                                    <input type="text" name="search" value="" placeholder="Search..." class="input-text">
                                    <button type="submit" name="ok"><i class="biolife-icon icon-search"></i></button>
                                </form>
                            </div>
                        </div>


                        <!--Posts Widget-->
                        <div class="widget posts-widget">
                            <h4 class="wgt-title">Recent post</h4>
                            <div class="wgt-content">
                                <ul class="posts">
                                    @foreach($recentBlog as $blog)
                                    <li>
                                        <div class="wgt-post-item">
                                            <div class="thumb">
                                                <a href="{{route('blog.details',$blog->slug)}}"><img src="{{$blog->image}}" width="80" height="58" alt=""></a>
                                            </div>
                                            <div class="detail">
                                                <h4 class="post-name"><a href="{{route('blog.details',$blog->slug)}}">{{$blog->title}}</a></h4>
                                                <p class="post-archive">{{formatted_date($blog->created_at)}} </p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>



                    </div>
                </aside>
            </div>
        </div>
    </div>


@endsection
