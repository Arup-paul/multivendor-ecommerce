@extends('admin.layout.layout',[
    'prev' => route('admin.categories.index')
])

@section('title', 'Add New Category')

@section('content')
    <section class="section">
      <form method="POST" action="{{route('admin.categories.store')}}" class="ajaxform_with_reset"  >
            @csrf
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body  ">
                            <div class="form-group">
                                <label for="category_name" class="required">{{ __('Category Name') }} </label>
                                <input type="text"  name="category_name"  class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Section') }} </label>
                                 <select name="section_id" id="section_id" class="form-control">
                                        <option value="">Select Section</option>
                                     @foreach($sections as $section)
                                          <option value="{{$section->id}}">{{$section->name}}</option>
                                     @endforeach
                                 </select>
                            </div>
                               <div id="appendCategoriesLevel">
                                      @include('admin.categories.append-categories-level')
                               </div>



                            <div class="form-group">
                                <label for="name"  >{{ __('Category Discount(%)') }} </label>
                                <input type="text"  name="category_discount" class="form-control"   >
                            </div>

                            <label for="url"  >{{ __('Category Image') }} </label>
                            {{ mediasection([
                                        'input_name' => 'category_image',
                                        'input_id' => 'category_image',
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
                         <label for="url"  >{{ __('Category URL') }} </label>
                         <input type="text"  name="url" class="form-control"   >
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
