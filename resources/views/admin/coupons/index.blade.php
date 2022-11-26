@extends('admin.layout.layout',[
    'button_name' => 'Add New',
    'button_link' => route('admin.coupons.create')
])

@section('title', 'Coupon')

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.coupons.mass-destroy') }}" class="ajaxform_with_reload">
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
                            <th>{{ __('Coupon Code') }}</th>
                            <th>{{ __('Coupon Type') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($coupons as $key => $coupon)
                            <tr>
                                <td> <input type="checkbox" name="ids[]" value="{{ $coupon->id }}"></td>
                                <td>{{ $coupon->coupon_code }}</td>
                                <td>{{ $coupon->coupon_type }}</td>
                                <td>
                                    {{ $coupon->amount }}
                                     @if($coupon->coupon_type == 'Percentage')
                                         %
                                    @else
                                         $
                                    @endif
                                </td>
                                <td>{{ $coupon->start_date }}</td>
                                <td>{{ $coupon->end_date }}</td>
                                <td>
                                    @if($coupon->status == 1)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                       href="{{route('admin.coupons.edit',$coupon->id)}}">
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
            {{ $coupons->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

