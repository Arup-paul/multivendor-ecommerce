@extends('admin.layout.layout',[
    'prev' => route('admin.filter-values.index')
])

@section('title', 'Update Filter Values')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body "  >
                        <form method="POST" action="{{route('admin.filter-values.update',$filterValue->id)}}" class="ajaxform"  >
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Filter Value') }} </label>
                                <input type="text" value="{{$filterValue->filter_value}}"  name="filter_value" class="form-control"   >
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="required">{{ __('Filter Name') }} </label>
                                <select name="product_filter_id" id="category_id" class="form-control" >
                                    <option value="">Select Filter</option>
                                    @foreach($filterData as $row)
                                        <option @selected($filterValue->product_filter_id == $row->id) value="{{$row->id}}">{{$row->filter_name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="password" class="required">{{ __('Status') }}</label>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

