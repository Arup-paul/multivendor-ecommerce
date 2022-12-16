@extends('admin.layout.layout',[
    'prev' => route('admin.admins')
])

@section('title', 'Update  Admin/Subadmin')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body "  >
                        <form method="POST" action="{{route('admin.admins.update',$admin->id)}}" class="ajaxform"  >
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Name') }} </label>
                                <input type="text" value="{{$admin->name}}"  name="name" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="required">{{ __('Mobile No') }} </label>
                                <input type="text" value="{{$admin->mobile}}" name="mobile" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="email" class="required">{{ __('Email') }} </label>
                                <input type="email" value="{{$admin->email}}"  name="email" class="form-control"   >
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
                                    <option @selected($admin->type == 'superadmin') value="superadmin">{{ __('Super Admin') }}</option>
                                    <option @selected($admin->type == 'admin') value="admin">{{ __('Admin') }}</option>
                                    <option @selected($admin->type == 'moderator') value="moderator">{{ __('Moderator') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password" class="required">{{ __('Status') }}</label>
                                <select name="status" class="form-control">
                                    <option @selected($admin->status == 1) value="1">{{ __('Active') }}</option>
                                    <option @selected($admin->status == 0) value="0">{{ __('Inactive') }}</option>
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
