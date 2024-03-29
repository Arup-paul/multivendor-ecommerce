@extends('admin.layout.layout',[
    'prev' => route('admin.filters.index')
])

@section('title', 'Update Filters')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body "  >
                        <form method="POST" action="{{route('admin.filters.update',$filter->id)}}" class="ajaxform"  >
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Filter Name') }} </label>
                                <input type="text"  name="filter_name" value="{{$filter->filter_name}}" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Filter Column') }} </label>
                                <input type="text" disabled value="{{$filter->filter_column}}" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="category_id" class="required">{{ __('Category') }} </label>
                                <select name="category_id[]" id="category_id" class="form-control select2" multiple="" >
                                    <option value="" >Select Category</option>
                                    @foreach($categories as $category)
                                        <option @if(in_array($category->id,explode(',',$filter->category_id))) selected @endif value="{{$category->id}}">{{$category->category_name}}</option>
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

