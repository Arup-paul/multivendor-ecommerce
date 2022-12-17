@extends('admin.layout.layout',[
    'prev' => route('admin.ratings.index')
])

@section('title', 'Update Rating')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body overflow-auto" style="max-height: 600px">
                        <form method="POST" action="{{route('admin.ratings.update',$review->id)}}" class="ajaxform"  >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Product Name') }} </label>
                                <input type="text" disabled value="{{$review->product->product_name}}"    class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Product Rating') }} </label>
                                <input type="number"   value="{{$review->rating}}"  name="rating" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" >{{ __('Product Review') }} </label>
                                <input type="text"   value="{{$review->review}}"  name="review" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="password" class="required">{{ __('Status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1" @selected($review->status == 1)>{{ __('Active') }}</option>
                                    <option value="0" @selected($review->status == 0)>{{ __('Inactive') }}</option>
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
@endpush


@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/media.js') }}"></script>
@endpush

