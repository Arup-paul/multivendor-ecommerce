@extends('admin.layout.layout',[
    'prev' => route('admin.products.index')
])

@section('title', 'Add/Update Product Images')

@section('content')
    <section class="section">

            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-body  ">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="product_name" class="required">{{ __('Product Name') }} </label>
                                        <input  readonly value="{{$product->product_name}}"  class="form-control"   >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="product_color" class="required">{{ __('Product Color') }} </label>
                                        <input readonly value="{{$product->product_color}}"  class="form-control"   >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="product_code" class="required">{{ __('Product Code') }} </label>
                                        <input  readonly value="{{$product->product_code}}" class="form-control"   >
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="product_price" class="required">{{ __('Product Price') }} </label>
                                        <input readonly value="{{$product->product_price}}"  class="form-control"   >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="product_price" class="required">{{ __('Product Image') }} </label>
                                        <img src="{{asset($product->product_image)}}" width="200px" height="200px" alt="">
                                    </div>
                                </div>
                            </div>

                            <h4>{{ __('Add New Image') }}</h4>
                            <form method="POST" action="{{route('admin.product-images.store')}}" class="ajaxform"   >
                                @csrf

                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                {{ mediasection([
                                    'input_name' => 'product_image',
                                    'input_id' => 'product_image',
                                    ]) }}

                            <div class="form-group pt-2">
                                <button class="btn btn-primary   basic-btn"  >
                                    <i class="fas fa-save"> </i>
                                    {{ __('Save') }}
                                </button>
                            </div>
                       </form>

                        </div>

                        <div class="card-body  ">
                             <h4>{{ __('Product Image') }}</h4>
                            <form method="POST" action="{{route('admin.product-images.update')}}" class="ajaxform"   >
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <table class="table table-hover table-nowrap card-table text-center">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                  </thead>
                                        <tbody class="list font-size-base  " >
                                        @foreach($product->images as $key =>  $image)
                                            <tr>
                                               <td>{{$key+1}} </td>
                                               <td>
                                                   <img src="{{asset($image->image)}}" width="200" height="200" alt="">
                                               </td>

                                               <td>
                                                   <select name="status[]" class="form-control" style="width: 100px" >
                                                         <option value="1" @selected($image->status == 1)  >{{ __('Active') }}</option>
                                                         <option value="0" @selected($image->status == 0)>{{ __('Inactive') }}</option>
                                                   </select>
                                                   <input   type="hidden" name="id[]"   value="{{$image->id}}"/>
                                               </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                <div class="card-footer float-right">
                                    {{ $product->images->links('vendor.pagination.bootstrap-4') }}
                                </div>


                                <div class="form-group pt-2">
                                    <button class="btn btn-primary "  >
                                        <i class="fas fa-save"> </i>
                                        {{ __('Update Status') }}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

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


