@extends('admin.layout.layout',[
    'button_name' => 'Add New',
    'button_link' => route('admin.admins.create')
])

@section('title', 'Admin/SubAdmin')


@section('content')

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$all->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Super Admin') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$superAdminCount->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Admin') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$adminCount->count()}}
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="card">
        <div class="card-header">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ request('type') == null ? 'active  bg-success' : '' }} " href="{{ route('admin.admins') }}">
                                {{ __('All') }}<span class="badge  {{ request('type') == null ? 'badge-white' : 'badge-primary' }} ">{{$all->count()}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('type') == 'superadmin' ? 'active bg-success' : '' }} " href="{{ route('admin.admins', ['type' => 'superadmin']) }}">
                                {{ __('Super Admin') }} <span class="badge  {{ request('type') == 'superadmin' ? 'badge-white' : 'badge-primary' }} ">{{$superAdminCount->count()}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('type') == 'admin' ? 'active bg-success' : '' }} " href="{{ route('admin.admins', ['type' => 'admin']) }}">
                                {{ __('Admin') }} <span class="badge  {{ request('type') == 'admin' ? 'badge-white' : 'badge-primary' }} ">{{$adminCount->count()}}</span>
                            </a>
                        </li>



                    </ul>

                </div>

            </div>
        </div>
        <div class="card-body">
                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                    <form method="post" action="{{ route('admin.admins.mass-destroy') }}" class="ajaxform_with_reload">
                        @csrf
                        <div class="float-left mb-3">
                            <div class="input-group">
                                <select class="form-control action" name="deleteAction">
                                    <option value="">{{ __('Select Action') }}</option>
                                    <option value="delete">{{ __('Delete Permanently') }}</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    <table class="table table-hover table-nowrap card-table text-center">
                        <thead>
                        <tr>
                            <th><input type="checkbox" class="checkAll"></th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Mobile') }}</th>
                            <th>{{ __('Registered At') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($admins as $key => $admin)
                            <tr>
                                <td> <input type="checkbox" name="ids[]" value="{{ $admin->id }}"></td>
                                <td class="text-left">{{ $admin->name }}</td>
                                <td>{{ $admin->type }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->mobile }}</td>
                                <td>{{ formatted_date($admin->created_at) }}</td>
                                <td>
                                    @if($admin->status == 1)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif

                                </td>
                                <td>
                                    @if($admin->type !== 'superadmin')
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item has-icon updateStatus"
                                           href="javascript:void(0);" data-action="{{route('admin.admins.update-status',$admin->id)}}">
                                            <i class="fa fa-check-circle @if($admin->status == 1) text text-success @else text text-danger @endif "></i>
                                            {{ __('Change Status') }}
                                        </a>
                                        <a class="dropdown-item has-icon"
                                           href="{{route('admin.admins.edit',$admin->id)}}">
                                            <i class="fa fa-pencil-alt"></i>
                                            {{ __('Edit') }}
                                        </a>
                                            <a class="dropdown-item has-icon"
                                               href="{{route('admin.role-permission',$admin->id)}}">
                                                <i class="fa fa-unlock"></i>
                                                {{ __('Role/Permission') }}
                                            </a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </form>
                </div>
        </div>
        <div class="card-footer">
            {{ $admins->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

