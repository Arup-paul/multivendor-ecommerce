@extends('admin.layout.layout')

@section('title', 'Review Rating')

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.ratings.mass-destroy') }}" class="ajaxform_with_reload">
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
                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('Product Image') }}</th>
                            <th>{{ __('User Name') }}</th>
                            <th>{{ __('Rating') }}</th>
                            <th>{{ __('Review') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($reviews as $key => $review)
                            <tr>
                                <td> <input type="checkbox" name="ids[]" value="{{ $review->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $review->product->product_name }}</td>
                                <td><img src="{{asset($review->product->product_image ?? '')}}" height="200" width="200" alt=""></td>
                                <td>{{ $review->user->name }}</td>
                                <td>{{ $review->rating }}</td>
                                <td>{{ $review->review }}</td>
                                <td>
                                    @if($review->status == 1)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                       href="{{route('admin.ratings.edit',$review->id)}}">
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
            {{ $reviews->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

