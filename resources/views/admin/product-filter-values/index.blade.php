@extends('admin.layout.layout',[
    'button_name' => 'Add New',
    'button_link' => route('admin.filter-values.create')
])

@section('title', 'Filter Values')

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.filter-values.mass-destroy') }}" class="ajaxform_with_reload">
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
                            <th>{{ __('Filter Name') }}</th>
                            <th>{{ __('Filter Value') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($filters as $key => $filter)
                            <tr>
                                <td> <input type="checkbox" name="ids[]" value="{{ $filter->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $filter->productFilter->filter_name }}</td>
                                <td>{{ $filter->filter_value }}</td>
                                <td>
                                    @if($filter->status == 1)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                       href="{{route('admin.filter-values.edit',$filter->id)}}">
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
            {{ $filters->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

