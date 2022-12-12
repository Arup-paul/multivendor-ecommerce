@extends('admin.layout.layout',[
//    'button_name' => 'Add New',
//    'button_link' => route('admin.categories.create')
])

@section('title', 'Vendor')
@section('content')


    <div class="card">
        <div class="card-header">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == null ? 'active  bg-primary' : '' }} " href="{{ route('admin.vendors.index') }}">
                                {{ __('All') }}<span class="badge  {{ request('status') == null ? 'badge-white' : 'badge-primary' }} ">{{$all->count()}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 1 ? 'active bg-success' : '' }} " href="{{ route('admin.vendors.index', ['status' => 1]) }}">
                                {{ __('Active') }} <span class="badge  {{ request('status') == 0 ? 'badge-white' : 'badge-primary' }} ">{{$active->count()}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') ==  '0' ? 'active bg-danger' : '' }} " href="{{ route('admin.vendors.index', ['status' => '0']) }}">
                                {{ __('In Active') }} <span class="badge  {{ request('status') == '0' ? 'badge-white' : 'badge-primary' }} ">{{$inactive->count()}}</span>
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
                        @foreach($vendors as $key => $admin)
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
                                            <a class="dropdown-item has-icon"
                                               href="{{route('admin.vendor-details',$admin->id)}}">
                                                <i class="fa fa-eye"></i>
                                                {{ __('View') }}
                                            </a>



                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
        </div>
        <div class="card-footer">
            {{ $vendors->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

