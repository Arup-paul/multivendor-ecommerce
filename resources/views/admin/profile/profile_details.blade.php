@extends('admin.layout.layout', [
   'prev'=> url()->previous()
])

@section('title','Update Profile Details')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body" >
                        <form method="POST" action="{{route('admin.update-profile-details')}}" class="ajaxform"  >
                          @csrf
                            <div class="form-group">
                                <label for="password" class="required">Admin Type</label>
                                <input type="text" disabled class="form-control" value="{{auth()->guard('admin')->user()->type}}"  readonly >
                            </div>
                            <div class="form-group">
                                <label for="password" class="required">Admin Email</label>
                                <input type="email" name="email"   class="form-control" value="{{auth()->guard('admin')->user()->email}}"  >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">Name</label>
                                <input type="text" name="name" id="name" class="form-control" min="8" placeholder="Enter Name" value="{{auth()->guard('admin')->user()->name}}" required="" >
                             </div>
                            <div class="form-group">
                                <label for="mobile" class="required">Name</label>
                                <input type="text" name="mobile" id="mobile" class="form-control" min="8" placeholder="Enter Mobile Number" value="{{auth()->guard('admin')->user()->mobile}}" required="" >
                            </div>

                            {{ mediasection([
                                             'input_name' => 'preview',
                                              'input_id' => 'preview',
                                              'preview' => auth()->guard('admin')->user()->image ?? null,
                                              'value' => auth()->guard('admin')->user()->image ?? null,
                                          ]) }}



                            <div class="form-group">
                                <button class="btn btn-primary float-right basic-btn"  >
                                    <i class="fas fa-save"> </i>
                                    Save
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
      @push('script')
        <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/media.js') }}"></script>
    @endpush
