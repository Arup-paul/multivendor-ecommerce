@extends('frontend.layouts.layouts')
@section('content')
    <div class="login-background">
    <div class="container container-xxl ">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                @include('frontend.user.sidebar')
            </div>


            <!--checkout progress box-->
            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">

                <div class="signin-container user-container  panel  ">
                    <div class="panel-body ">
                        <h3>Review Rating</h3>
                        <table>
                            <thead>
                              <tr>
                                  <th>SL</th>
                                  <th>Product Name</th>
                                  <th>Product Image</th>
                                  <th>Rating</th>
                                  <th>Review</th>
                                  <th>View</th>
                              </tr>
                            </thead>

                            <tbody>
                            @foreach($reviews as $key => $review)
                              <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$review->product->product_name}}</td>
                                  <td><img src="{{asset($review->product->product_image)}}" width="150" height="150" alt=""></td>
                                  <td>{{$review->rating}}</td>
                                  <td>{{$review->review ?? ''}}</td>
                                  <td>
                                      <a title="view product" href="{{route('product.details',$review->product->slug)}}" title="View" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                  </td>
                              </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>

@endsection
