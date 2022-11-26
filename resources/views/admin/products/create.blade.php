@extends('admin.layout.layout',[
    'prev' => route('admin.products.index')
])

@section('title', 'Add New Product')

@section('content')
    <section class="section">
        <form method="POST" action="{{route('admin.products.store')}}" class="ajaxform_with_reset"  >
            @csrf
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-body  ">
                            <div class="form-group">
                                <label for="product_name" class="required">{{ __('Product Name') }} </label>
                                <input type="text"  name="product_name"  class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="product_color" class="required">{{ __('Product Color') }} </label>
                                <input type="text"  name="product_color"  class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="product_code" class="required">{{ __('Product Code') }} </label>
                                <input type="text"  name="product_code"  class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="product_price" class="required">{{ __('Product Price') }} </label>
                                <input type="text"  name="product_price"  class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="product_discount" class="required">{{ __('Product Discount') }} </label>
                                <input type="text"  name="product_discount"  class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="product_weight" class="required">{{ __('Product Weight') }} </label>
                                <input type="text"  name="product_weight"  class="form-control"   >
                            </div>


                            <div class="form-group">
                                <label for="category_id" class="required">{{ __('Category') }} </label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @foreach($category->subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}">  &nbsp;&nbsp; -- {{$subcategory->category_name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div id="appendFilter">
                                @include('admin.products.filters')
                            </div>


                            <div class="form-group">
                                <label for="brand_id" class="required">{{ __('Brand') }} </label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="" class="required"  >{{ __('Product Image') }} </label>
                            {{ mediasection([
                                        'input_name' => 'product_image',
                                        'input_id' => 'product_image',
                            ]) }}

                            <div class="form-group">
                                <label for="description"  >{{ __('Description') }} </label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_title"  >{{ __('Meta Title') }} </label>
                                <input type="text"  name="meta_title" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords"  >{{ __('Meta Keywords') }} </label>
                                <input type="text"  name="meta_keywords" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="meta_description"  >{{ __('Meta Description') }} </label>
                                <textarea class="form-control" name="meta_description" id="" cols="30" rows="10"></textarea>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body  ">
                            <div class="form-group">
                                <label for="featured" >{{ __('Featured') }}</label>
                                <select name="featured" class="form-control">
                                    <option value=""> Select </option>
                                    <option value="is_featured">{{ __('Is Featured') }}</option>
                                    <option value="is_latest">{{ __('Is Latest') }}</option>
                                    <option value="is_trending">{{ __('Is Trending') }}</option>
                                    <option value="is_best_rated">{{ __('Is Best Rated') }}</option>
                                    <option value="is_best_seller">{{ __('Is Best Seller') }}</option>
                                    <option value="is_most_viewed">{{ __('Is Most Viewed') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status" class="required">{{ __('Status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Inactive') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary float-right basic-btn"  >
                                    <i class="fas fa-save"> </i>
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    {{ mediasingle() }}
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush


@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/media.js') }}"></script>
@endpush
