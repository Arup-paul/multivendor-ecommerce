@extends('admin.layout.layout',[
    'button_name' => 'Add New',
    'button_link' => route('admin.blogs.create')
])

@section('title', 'Blog')

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.blogs.mass-destroy') }}" class="ajaxform_with_reload">
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
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="list font-size-base rowlink" data-link="row">
                        @foreach($blogs as $key => $blog)
                            <tr>
                                <td> <input type="checkbox" name="ids[]" value="{{ $blog->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td><img src="{{asset($blog->image ?? '')}}" height="200" width="200" alt=""></td>
                                <td>{{ $blog->title }}</td>
                                <td>
                                    @if($blog->status == 1)
                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary"
                                       href="{{route('admin.blogs.edit',$blog->id)}}">
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
            {{ $blogs->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

