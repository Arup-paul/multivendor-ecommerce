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
                                    <a href="{{route('blog.details',$blog->slug)}}" class="link-to-post"><img src="{{asset($blog->image)}}" width="370" height="300" alt=""></a>
                                </div>
                                <div class="post-content">
                                    <h4 class="post-name"><a href="#" class="linktopost">{{$blog->title}}</a></h4>
                                    <p class="post-archive"> <span class="post-date">{{formatted_date($blog->created_at)}}</span><span class="author">Posted By: Admin</span></p>
                                    <p class="excerpt">{{Str::limit($blog->short_description ?? null, 100, $end='.......')}}</p>
                                    <div class="group-buttons">
                                        <a href="{{route('blog.details',$blog->slug)}}" class="btn readmore">read more</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach


                    </ul>

                </div>

                <!--Panigation Block-->
                <div class="biolife-panigations-block ">
                    {{$blogs->links('vendor.pagination.custom')}}
                </div>

            </div>
        </div>
    </div>

@endsection
