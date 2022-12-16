@extends('admin.layout.layout',[
    'prev' => route('admin.admins')
])

@section('title', ' Update '. $admin->name .' ('.$admin->type.')'.' Role/Permissions')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    @php

                        if(!empty($rolePermission)){
                            foreach ($rolePermission as $role){
                                if($role->module == 'categories'){
                                    $viewCategories = $role->view == 1 ? 'checked' : '';
                                    $editCategories = $role->edit == 1 ? 'checked' : '';
                                    $createCategories = $role->create == 1 ? 'checked' : '';
                                    $allCategories = $role->all == 1 ? 'checked' : '';
                                }
                                 if($role->module == 'products'){
                                    $viewProducts = $role->view == 1 ? 'checked' : '';
                                    $editProducts = $role->edit == 1 ? 'checked' : '';
                                    $createProducts = $role->create == 1 ? 'checked' : '';
                                    $allProducts = $role->all == 1 ? 'checked' : '';
                                }
                            }
                        }
                    @endphp

                    <div class="card-body "  >
                        <form method="POST" action="{{route('admin.role-permission',$admin->id)}}" class="ajaxform"  >
                            @csrf
                            <div class="form-group">
                                <label for="name"  >{{ __('Categories') }} </label> <br>
                                <input type="checkbox" {{$viewCategories ?? ''}}  name="categories[view]" value="1" >&nbsp; View &nbsp;
                                <input type="checkbox" {{$editCategories ?? ''}}   name="categories[edit]"  value="1" >&nbsp; View/Edit  &nbsp;
                                <input type="checkbox" {{$createCategories ?? ''}}  name="categories[create]"  value="1" >&nbsp; View/Create  &nbsp;
                                <input type="checkbox" {{$allCategories ?? ''}}  name="categories[all]"  value="1" >&nbsp; Full Access &nbsp;
                                <input type="hidden" name="categories['empty']" value="0">
                            </div>

                            <div class="form-group">
                                <label for="name"  >{{ __('Products') }} </label> <br>
                                <input type="checkbox" {{$viewProducts ?? ''}}  name="products[view]" value="1" >&nbsp; View &nbsp;
                                <input type="checkbox"  {{$editProducts ?? ''}} name="products[edit]"  value="1" >&nbsp; View/Edit  &nbsp;
                                <input type="checkbox"  {{$createProducts ?? ''}} name="products[create]"  value="1" >&nbsp; View/Create  &nbsp;
                                <input type="checkbox"  {{$allProducts ?? ''}} name="products[all]"  value="1" >&nbsp; Full Access &nbsp;
                                <input type="hidden" name="products['empty']" value="0">
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
