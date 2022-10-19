@extends('admin.layout.layout',[
    'prev' => route('admin.products.index')
])

@section('title', 'Add/Update Product Attribute')

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

                            <form method="POST" action="{{route('admin.product-attributes.store')}}" class="ajaxform_with_reset"   >
                                @csrf

                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="field_wrapper">

                                        <div class="row">
                                            <div class="col-md-10 col-12">
                                                <div class="row">
                                                    <div class="col-md-3 col-6">
                                                        <input class="form-control" type="text" name="sku[]" placeholder="SKU" value=""/>
                                                    </div>
                                                    <div class="col-md-3 col-6">
                                                        <input class="form-control" type="number" name="price[]" placeholder="Price" value=""/>
                                                    </div>
                                                    <div class="col-md-3 col-6">
                                                        <input class="form-control" type="text" name="size[]" placeholder="Size" value=""/>
                                                    </div>
                                                    <div class="col-md-3 col-6">
                                                        <input class="form-control" type="text" name="stock[]" placeholder="Stock" value=""/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-3">
                                                <a href="javascript:void(0);" class="add_button btn btn-primary  " title="Add field"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                </div>
                            <div class="form-group pt-2">
                                <button class="btn btn-primary   basic-btn"  >
                                    <i class="fas fa-save"> </i>
                                    {{ __('Save') }}
                                </button>
                            </div>
                       </form>

                        </div>

                        <div class="card-body  ">
                             <h4>{{ __('Product Attribute') }}</h4>
                            <form method="POST" action="{{route('admin.product-attributes.update')}}" class="ajaxform"   >
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <table class="table table-hover table-nowrap card-table text-center">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SKU') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Size') }}</th>
                                            <th>{{ __('Stock') }}</th>
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                  </thead>
                                        <tbody class="list font-size-base  " >
                                        @foreach($product->attributes as $attribute)
                                            <tr>
                                               <td><input class="form-control" type="text" name="sku[]" placeholder="SKU" value="{{$attribute->sku}}"/></td>
                                               <td><input class="form-control" type="number" name="price[]" placeholder="Price" value="{{$attribute->price}}"/></td>
                                               <td><input class="form-control" type="text" name="size[]" placeholder="Size" value="{{$attribute->size}}"/></td>
                                               <td><input class="form-control" type="text" name="stock[]" placeholder="Stock" value="{{$attribute->stock}}"/></td>
                                               <td>
                                                   <select name="status[]" class="form-control" style="width: 100px" >
                                                         <option value="1" @selected($attribute->status == 1)  >{{ __('Active') }}</option>
                                                         <option value="0" @selected($attribute->status == 0)>{{ __('Inactive') }}</option>
                                                   </select>
                                                   <input   type="hidden" name="id[]"   value="{{$attribute->id}}"/>
                                               </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                <div class="card-footer float-right">
                                    {{ $product->attributes->links('vendor.pagination.bootstrap-4') }}
                                </div>


                                <div class="form-group pt-2">
                                    <button class="btn btn-primary "  >
                                        <i class="fas fa-save"> </i>
                                        {{ __('Update Attribute') }}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

    </section>

@endsection



@push('script')
  <script>
      $(document).ready(function(){
          var maxField = 10; //Input fields increment limitation
          var addButton = $('.add_button'); //Add button selector
          var wrapper = $('.field_wrapper'); //Input field wrapper
          var fieldHTML =   '<div class="row pt-2">'+
              '<div class="col-md-10 col-12">'+
              '<div class="row">'+
             '<div class="col-md-3 col-6">'+
              '<input class="form-control" type="text" name="sku[]" placeholder="SKU" value=""/>'+
              '</div>'+
         '<div class="col-md-3 col-6">'+
             '<input class="form-control" type="number" name="price[]" placeholder="Price" value=""/>'+
          '</div>'+
          '<div class="col-md-3 col-6">'+
             '<input class="form-control" type="text" name="size[]" placeholder="Size" value=""/>'+
         ' </div>'+
          '<div class="col-md-3 col-6">'+
          '<input class="form-control" type="text" name="stock[]" placeholder="Stock" value=""/>'+
          '</div>'+
     '</div>'+
     '</div>'+
          '<div class="col-md-2 col-3">'+
            '<a href="javascript:void(0);" class="remove_button btn btn-danger"><i class="fa fa-minus"></i></a>'+
          '</div>'

          var x = 1; //Initial field counter is 1

          //Once add button is clicked
          $(addButton).click(function(){
              //Check maximum number of input fields
              if(x < maxField){
                  x++; //Increment field counter
                  $(wrapper).append(fieldHTML); //Add field html
              }
          });

          //Once remove button is clicked
          $(wrapper).on('click', '.remove_button', function(e){
              e.preventDefault();
                $(this).parent('div').parent('div').remove(); //Remove field html
               x--; //Decrement field counter
          });
      });
  </script>
@endpush
