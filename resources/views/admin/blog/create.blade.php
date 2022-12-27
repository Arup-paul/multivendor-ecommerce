@extends('admin.layout.layout',[
    'prev' => route('admin.blogs.index')
])

@section('title', 'Add New Blog')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body "  >
                        <form method="POST" action="{{route('admin.blogs.store')}}" class="ajaxform_with_reset"  >
                            @csrf
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Title') }} </label>
                                <input type="text"  name="title" class="form-control"   >
                            </div>

                            <div class="from-group row mb-2">
                                <label for="" class="col-lg-12">{{ __('Content :') }} </label>
                                <div class="col-lg-12">
                                    <textarea name="description" class="summernote"></textarea>
                                </div>
                            </div>
                            <label for="url"  >{{ __(' Image') }} </label>
                            {{ mediasection([
                                        'input_name' => 'image',
                                        'input_id' => 'image',
                            ]) }}
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Meta Title') }} </label>
                                <input type="text"  name="meta_title" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Meta Description') }} </label>
                                <input type="text"  name="meta_description" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Meta Keywords') }} </label>
                                <input type="text"  name="meta_keywords" class="form-control"   >
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
    {{ mediasingle() }}

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/media.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote.js') }}"></script>
@endpush
