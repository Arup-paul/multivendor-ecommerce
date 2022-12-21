@extends('admin.layout.layout')


@section('content')


    <div class="card">
        <div class="card-header">
            <h4>{{ __('Return Order') }}</h4>

        </div>
        <div class="card-body">

                <div class="clearfix mb-3"></div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap card-table text-center">
                        <thead>
                        <tr>
                            <th class="text-left">{{ __('Order Id') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Product Image') }}</th>
                            <th>{{ __('Product Size') }}</th>
                            <th>{{ __('Reason') }}</th>
                            <th>{{ __('Comment') }}</th>
                            <th>{{ __('Return Status') }}</th>
                            <th colspan="2">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($returnOrders as $order)
                            <tr>
                                <td> <a  href="{{ route('admin.orders.show', $order->order_id) }}"> {{$order->order_id}}</a></td>
                                <td> <a  href="#"> {{$order->user->name}}</a></td>
                                <td>  {{$order->product->product_name}} </td>
                                <td><img src="{{asset($order->product->product_image)}}" width="120px" height="120px" alt=""></td>
                                <td>{{$order->product_size}}</td>
                                <td>{{$order->reason ?? ''}}</td>
                                <td>{{$order->comment ?? ''}}</td>
                                <td>{{$order->return_status}}</td>
                                <td colspan="2">
                                    <form action="{{route('admin.orders.return.update',$order->id)}}" method="post" class="ajaxform">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->order_id}}">
                                        <input type="hidden" name="product_id" value="{{$order->product_id}}">
                                        <select class="form-control" name="return_status" id="">
                                            <option  @selected($order->return_status == 'Pending') value="Pending">Pending</option>
                                            <option  @selected($order->return_status == 'Approved') value="Approved">Approved</option>
                                            <option  @selected($order->return_status == 'Rejected') value="Rejected">Rejected</option>
                                        </select>
                                        <button class="btn btn-primary  mt-2 basic-btn"  >
                                            <i class="fas fa-save"> </i>
                                            {{ __('Update') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
        </div>
        <div class="card-footer">
            {{ $returnOrders->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>



@endsection
