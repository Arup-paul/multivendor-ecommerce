@extends('admin.layout.layout')


@section('content')
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary text-white">
                    <i class="fa fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Users') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$users->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success text-white">
                    <i class="fa fa-user-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Active Users') }}</h4>
                    </div>
                    <div class="card-body">
                          {{$active_users}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger text-white">
                    <i class="fa fa-user-alt-slash"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Pending Users') }}</h4>
                    </div>
                    <div class="card-body">
                           {{$deactive_users}}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h4>{{ __('Customer List') }}</h4>
            <form class="card-header-form">
                <div class="input-group">
                    <input type="text" name="src" value="{{ request('src') }}" class="form-control" placeholder="{{ __('Search email or mobile') }}"/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>

        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.customers.mass-destroy') }}" class="ajaxform_with_reload">
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
                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap card-table text-center">
                        <thead>
                        <tr>
                            <th><input type="checkbox" class="checkAll"></th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Mobile') }}</th>
                            <th>{{ __('Registered At') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($users as $key => $user)
                            <tr>
                                <td> <input type="checkbox" name="ids[]" value="{{ $user->id }}"></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ formatted_date($user->created_at) }}</td>

                                <td>
                                    @if($user->status == 0 )
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @elseif($user->status == 1)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
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
                                        <a class="dropdown-item has-icon"
                                           href="{{ route('admin.customers.edit', $user->id) }}">
                                            <i class="fa fa-edit"></i>
                                            {{ __('Edit') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </form>
        </div>
        <div class="card-footer">
            {{ $users->links('vendor.pagination.bootstrap-4') }}

        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="searchmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="card-header-title">{{ __('Filters') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group row mb-4">
                            <label class="col-sm-7" for="payment_status">{{ __('Payment Status') }}</label>
                            <div class="col-sm-5">
                                <select class="form-control selectric" name="payment_status" id="payment_status">
                                    <option selected disabled>{{ __('Payment Status') }}</option>
                                    <option value="2" @selected(request('payment_status') == 2)>{{ __('Pending') }}</option>
                                    <option value="1" @selected(request('payment_status') == 1)>{{ __('Complete') }}</option>
                                    <option value="3" @selected(request('payment_status') == 3)>{{ __('Incomplete') }}</option>
                                    <option value="0" @selected(request('payment_status') == '0')>{{ __('Cancel') }}</option>
                                </select>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group row mb-4">
                            <label class="col-sm-3">{{ __('Starting date') }}</label>
                            <div class="col-sm-9">
                                <input type="date" name="start" class="form-control" value="{{ request('start') }}" />
                            </div>
                        </div>
                        <hr />
                        <div class="form-group row mb-4">
                            <label class="col-sm-3">{{ __('Ending date') }}</label>
                            <div class="col-sm-9">
                                <input type="date" name="end" class="form-control" value="{{ request('end') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-dark">
                            {{ __('Clear Filter') }}
                        </a>
                        <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
