@extends('admin.layout.layout',[
    'prev' => route('admin.admins')
])

@section('title', 'Add New Admin/Subadmin')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body "  >
                        <form method="POST" action="{{route('admin.admins.store')}}" class="ajaxform_with_reset"  >
                            @csrf
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Name') }} </label>
                                <input type="text"  name="name" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="required">{{ __('Mobile No') }} </label>
                                <input type="text"  name="mobile" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="email" class="required">{{ __('Email') }} </label>
                                <input type="email"  name="email" class="form-control"   >
                            </div>

                            <div class="form-group">
                                <label for="name" class="required">{{ __('Password') }} </label>
                                <input type="password"  name="password" class="form-control"   >
                            </div>

                            <label for="url"  >{{ __('Image') }} </label>
                            {{ mediasection([
                                        'input_name' => 'image',
                                        'input_id' => 'image',
                            ]) }}

                            <div class="form-group">
                                <label for="password" class="required">{{ __('Role') }}</label>
                                <select name="role" class="form-control">
                                    <option value="">Select Role</option>
                                    <option value="superadmin">{{ __('Super Admin') }}</option>
                                    <option value="admin">{{ __('Admin') }}</option>
                                    <option value="moderator">{{ __('Moderator') }}</option>
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
    {{ mediasingle() }}

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/media.js') }}"></script>
@endpush
