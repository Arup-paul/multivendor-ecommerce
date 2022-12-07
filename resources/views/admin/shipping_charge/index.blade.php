@extends('admin.layout.layout',[
    'button_name' => 'Add New',
    'button_link' => route('admin.shipping-charge.create')
])

@section('title', 'Shipping Charge')

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.shipping-charge.mass-destroy') }}" class="ajaxform_with_reload">
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
                            <th>{{ __('SL') }}</th>
                            <th>{{ __('Country') }}</th>
                            <th>{{ __('0 to 500 gm') }}</th>
                            <th>{{ __('501 to 1000 gm') }}</th>
                            <th>{{ __('1001 to 2000 gm') }}</th>
                            <th>{{ __('2001 to 5000 gm') }}</th>
                            <th>{{ __('Above 5000 gm') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($shippingCharges as $key => $data)
                            <tr>
                                <td> <input type="checkbox" name="ids[]" value="{{ $data->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $data->country }}</td>
                                <td>{{ $data->zero_fiveHundred }}</td>
                                <td>{{ $data->fiveHundredOne_oneThousand }}</td>
                                <td>{{ $data->oneThousandOne_twoThousand }}</td>
                                <td>{{ $data->twoThousandOne_fiveThousand }}</td>
                                <td>{{ $data->above_FiveThousand }}</td> 
                                <td>
                                    @if($data->status == 1)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                       href="{{route('admin.shipping-charge.edit',$data->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </form>
        </div>
        <div class="card-footer">
            {{ $shippingCharges->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

