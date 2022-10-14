@extends('admin.layout.layout')


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
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Vendor') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$vendorCount->count()}}
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

                        <li class="nav-item">
                            <a class="nav-link {{ request('type') == 'vendor' ? 'active bg-success' : '' }} " href="{{ route('admin.admins', ['type' => 'vendor']) }}">
                                {{ __('Vendor') }} <span class="badge  {{ request('type') == 'vendor' ? 'badge-white' : 'badge-primary' }} ">{{$vendorCount->count()}}</span>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>
        </div>
        <div class="card-body">
                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap card-table text-center">
                        <thead>
                        <tr>
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
                                        @if($admin->type == 'vendor')
                                            <a class="dropdown-item has-icon"
                                               href="{{route('admin.vendor-details',$admin->id)}}">
                                                <i class="fa fa-eye"></i>
                                                {{ __('View') }}
                                            </a>
                                        @endif


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
        </div>
        <div class="card-footer">
            {{ $admins->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

