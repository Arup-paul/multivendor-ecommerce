@extends('admin.layout.layout',[
     'prev'=> route('admin.pages.index')
])

@section('title', __('Edit  Page'))

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.pages.update',$page->id) }}" enctype="multipart/form-data"
          class="ajaxform">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-9">
                <div class="card">

                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Page Title') }}</label>
                            <input type="text" class="form-control" value="{{$page->title}}" placeholder="{{ __('Page Title') }}" required name="title">
                        </div>

                        <div class="form-group">
                            <label>{{ __('Meta Title') }}</label>
                            <input type="text" class="form-control" value="{{$page->meta_title}}" placeholder="{{ __('Meta Title') }}"   name="meta_title">
                        </div>
                        <div class="from-group  mb-2 ">
                            <label>{{ __('Meta Keywords ') }} </label>
                            <textarea name="meta_keywords" cols="30"  rows="10" class="form-control">{{$page->meta_keywords}}</textarea>
                        </div>

                        <div class="from-group  mb-2">
                            <label>{{ __('Meta Description') }} </label>
                               <textarea name="meta_description" cols="30" rows="10" class="form-control">
                                    {{$page->meta_description}}
                                </textarea>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Page Content') }}</label>
                            <textarea name="description" class="summernote">{{$page->description}}</textarea>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="single-area">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-publish">
                                <button type="submit" class="btn btn-primary col-12 basic-btn"><i
                                        class="fa fa-save"></i> {{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="btn-publish">
                            <div class="form-group">
                                <label>{{ __('Status') }}</label>
                                <select name="status" class="form-control ">
                                    <option @selected($page->status == 1) value="1">{{ __('Active') }}</option>
                                    <option  @selected($page->status == 0) value="0">{{ __('Inactive') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="btn-publish">
                            <div class="form-group">
                                <label>{{ __('Position') }}</label>
                                <select name="position" class="form-control ">
                                    <option  @selected($page->position == 'left') value="left">{{ __('Left') }}</option>
                                    <option  @selected($page->position == 'right') value="right">{{ __('Right') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('admin/assets/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('admin/assets/js/summernote.js') }}"></script>
@endpush
