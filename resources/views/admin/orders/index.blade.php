@extends('admin.layout.layout')


@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Orders') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$all->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-clipboard"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Amount') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$all->sum('grand_total')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Order Complete') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$complete->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Processing Order') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$processing->count()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-history"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Shipping Orders') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$shipping->count()}}
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
                        <h4>{{ __('Order Pending') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$pending->count()}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Order Pending') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$cancel->count()}}
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
                        <h4>{{ __('Earning Amount') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$complete->sum('grand_total')}}
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
                        <h4>{{ __('Pending Amount') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$pending->sum('grand_total')}}
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
                        <h4>{{ __('Cancel Amount') }}</h4>
                    </div>
                    <div class="card-body">
                        {{$cancel->sum('grand_total')}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>{{ __('Orders') }}</h4>
            <form class="card-header-form">
                <div class="input-group">
                    <input type="text" name="src" value="{{ request('src') }}" class="form-control" placeholder="{{ __('Search by invoice or user') }}"/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <button class="btn btn-sm btn-primary  ml-1" type="button" data-toggle="modal" data-target="#searchmodal">
                <i class="fe fe-sliders mr-1"></i> {{ __('Filter') }} <span class="badge badge-primary ml-1 d-none">0</span>
            </button>
        </div>
        <div class="card-header">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ request('order_status') == null ? 'active' : '' }} " href="{{ route('admin.orders.index') }}">
                            {{ __('All') }}<span class="badge  {{ request('order_status') == null ? 'badge-white' : 'badge-primary' }} ">{{$all->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('order_status') == 3 ? 'active bg-success' : '' }} " href="{{ route('admin.orders.index', ['order_status' => 3]) }}">
                            {{ __('Complete') }} <span class="badge  {{ request('order_status') == 1 ? 'badge-white' : 'badge-primary' }} ">{{$complete->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('order_status') == '0' ? 'active bg-info' : '' }} " href="{{ route('admin.orders.index', ['order_status' => '0']) }}">
                            {{ __('Pending') }}<span class="badge  {{ request('order_status') == '0' ? 'badge-white' : 'badge-primary' }} ">{{$pending->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('order_status') == 1 ? 'active bg-info' : '' }} " href="{{ route('admin.orders.index', ['order_status' => 1]) }}">
                            {{ __('Processing') }}<span class="badge  {{ request('order_status') == 1 ? 'badge-white' : 'badge-primary' }} ">{{$processing->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('order_status') == 2 ? 'active bg-info' : '' }} " href="{{ route('admin.orders.index', ['order_status' => 2]) }}">
                            {{ __('Shipping') }}<span class="badge  {{ request('order_status') == 2 ? 'badge-white' : 'badge-primary' }} ">{{$shipping->count()}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('order_status') == 4 ? 'active bg-danger' : '' }} " href="{{ route('admin.orders.index', ['order_status' => 4]) }}">
                            {{ __('Cancel') }}<span class="badge  {{ request('order_status') == 4 ? 'badge-white' : 'badge-primary' }} ">{{$cancel->count()}}</span>
                        </a>
                    </li>
                </ul>
                    <a href="{{route('admin.orders.pdf')}}" class="btn btn-outline-danger btn-pdf pt-2 border-0"><i class="fa fa-file-pdf"></i> {{ __('PDF') }}</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.orders.mass-destroy') }}" method="POST" class="ajaxform_with_mass_delete">
                @csrf
                <div class="float-left">
                    <button class="btn btn-danger btn-lg basicbtn mass-delete-btn" id="submit-button" style="display: none;">{{ __('Delete') }}</button>
                </div>
                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap card-table text-center">
                        <thead>
                        <tr>
                            <th class="text-center pt-2">
                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                </div>
                            </th>
                            <th class="text-left">{{ __('Order Id') }}</th>
                            <th>{{ __('Payment Gateway') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Customer') }}</th>
                            <th class="text-right"> {{ __('Total') }}</th>
                            <th>{{ __('Payment') }}</th>
                            <th>{{ __('Order Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($orders as $key => $order)
                            <tr>
                                <td class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="id[]" id="order-{{ $order->id }}" class="custom-control-input checked_input" value="{{ $order->id }}"  data-checkboxes="mygroup">
                                        <label for="order-{{ $order->id }}" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td class="text-left">{{ $order->id }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ formatted_date($order->created_at) }}</td>
                                <td>
                                    <a href="#">{{ $order->users->name }}</a>
                                </td>
                                <td >{{ $order->grand_total  }}</td>
                                <td>
                                    @if($order->payment_status ==2)
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @elseif($order->payment_status ==1)
                                        <span class="badge badge-success">{{ __('Complete') }}</span>
                                    @elseif($order->payment_status == 0)
                                        <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                    @elseif($order->payment_status == 3)
                                        <span class="badge badge-danger">{{ __('Incomplete') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->order_status ==0)
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @elseif($order->order_status == 3)
                                        <span class="badge badge-success">{{ __('Complete') }}</span>
                                    @elseif($order->order_status == 4)
                                        <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                    @elseif($order->order_status == 1)
                                        <span class="badge badge-info">{{ __('Processing') }}</span>
                                    @elseif($order->order_status == 2)
                                        <span class="badge badge-info">{{ __('Shipping') }}</span>
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
                                           href="{{ route('admin.orders.show', $order->id) }}">
                                            <i class="fa fa-eye"></i>
                                            {{ __('View') }}
                                        </a>
                                        <a class="dropdown-item has-icon"
                                           href="{{ route('admin.orders.edit', $order->id) }}">
                                            <i class="fa fa-edit"></i>
                                            {{ __('Edit') }}
                                        </a>
                                        <a class="dropdown-item has-icon"
                                           href="{{ route('admin.orders.print.invoice', $order->id) }}">
                                            <i class="fa fa-print"></i>
                                            {{ __('Invoice') }}
                                        </a>

                                        <a class="dropdown-item has-icon delete-confirm"
                                           href="javascript:void(0)"
                                           data-action={{ route('admin.orders.destroy', $order->id) }}>
                                            <i class="fa fa-trash"></i>
                                            {{ __('Delete') }}
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
            {{ $orders->appends(['payment_status' => request('payment_status'), 'src' => request('src')])->links('vendor.pagination.bootstrap-4') }}
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
