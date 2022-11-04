@extends('admin.layout.layout',[
    'prev' => route('admin.sliders.index')
])

@section('title', 'Add New Slider')

@section('content')
    <section class="section">
      <form method="POST" action="{{route('admin.sliders.store')}}" class="ajaxform_with_reset"  >
            @csrf
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body  ">
                       <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} </label>
                            <input type="text"  name="title"  class="form-control"   >
                        </div>
                        <div class="form-group">
                            <label for="short_title" class="required">{{ __('Short Title') }} </label>
                            <input type="text"  name="short_title"  class="form-control"   >
                        </div>
                        <div class="form-group">
                            <label for="button_text" class="required">{{ __('Button Text') }} </label>
                            <input type="text"  name="button_text"  class="form-control"   >
                        </div>
                        <div class="form-group">
                            <label for="button_link" class="required">{{ __('Button Link') }} </label>
                            <input type="text"  name="button_link"  class="form-control"   >
                        </div>

                       <label for="url"  >{{ __('Banner') }} </label>
                        {{ mediasection([
                                   'input_name' => 'banner',
                                   'input_id' => 'banner',
                                   'preview_class' => 'banner',
                       ]) }}

                        <label for="url"  >{{ __('Child Image') }} </label>
                        {{ mediasection([
                                   'input_name' => 'child_image',
                                   'input_id' => 'child_image',
                                   'preview_class' => 'child_image',
                       ]) }}





                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                 <div class="card-body  ">
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
