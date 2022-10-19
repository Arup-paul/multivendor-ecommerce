@extends('admin.layout.layout',[
    'button_name' => 'Add New',
    'button_link' => route('admin.products.create')
])

@section('title', 'Products')

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.products.mass-destroy') }}" class="ajaxform_with_reload">
                @csrf
                <div class="float-left mb-3">
                    <div class="input-group">
                        <select class="form-control action" name="deleteAction">
                            <option value="">{{ __('Select Action') }}</option>
                            <option value="delete">{{ __('Delete Permanently') }}</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>
                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap card-table text-center">
                        <thead>
                        <tr>
                            <th><input type="checkbox" class="checkAll"></th>
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('Product Price') }}</th>
                            <th>{{ __('Product Image') }}</th>
                            <th>{{ __('Brand') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Added By') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($products as $key => $product)
                            <tr>
                                <td> <input type="checkbox" name="ids[]" value="{{ $product->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td><img src="{{asset($product->product_image )}}" alt="" height="150" width="150"></td>
                                <td>{{$product->brand->name}}</td>
                                <td>{{$product->category->category_name}}</td>
                                <td> @if($product->vendor == null) Admin @else {{$product->vendor->name}} @endif </td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                            <a class="dropdown-item has-icon"
                                               href="{{route('admin.products.edit',$product->id)}}">
                                                <i class="fa fa-edit"></i>
                                                {{ __('Edit') }}
                                            </a>
                                        <a class="dropdown-item has-icon"
                                           href="{{route('admin.product-attributes.create',$product->id)}}">
                                            <i class="fa fa-plus-square"></i>
                                            {{ __('Attribute') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </form>
        </div>
        <div class="card-footer">
            {{ $products->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

