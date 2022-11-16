

@extends('frontend.layouts.layouts')
@section('content')

   @include('frontend.partials.breadcrumb', ['title' => $vendor->shop_name])


    <div class="page-contain category-page left-sidebar">
        <div class="container">
            <div class="row">
                <!-- Main content -->
                <div id="main-content" class="main-content col-12">



                    <div class="product-category grid-style">

                        <div class="row">
                            <ul class="products-list filter-products">
                              @include('frontend.products.ajax_listing',['vendor' => true])
                            </ul>
                        </div>

                        <div class="biolife-panigations-block text-center">
                                {{$products->links('vendor.pagination.custom')}}
                        </div>

                    </div>

                </div>
                <!-- Sidebar -->

            </div>
        </div>
    </div>
@endsection

