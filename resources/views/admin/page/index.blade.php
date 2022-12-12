@extends('admin.layout.layout',[
    'button_name' => 'Add New',
    'button_link' => route('admin.pages.create')
])

@section('title', _('Page List'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.pages.mass-destroy') }}" class="ajaxform_with_reload">
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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAll"></th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Url') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $row)
                                <tr>
                                    <td> <input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
                                    <td>{{ $row->title }}</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text copyLinkBtn"   data-id="{{ url('/page',$row->slug) }}"  >{{ __('Copy link!') }}</button>
                                            </div>
                                            <input id="copy-link" class="form-control" type="text" value="{{ url('/page',$row->url) }}">
                                        </div>
                                    </td>
                                    @if($row->status == 1)
                                        <td class="text-success">{{ __('Active') }}</td>
                                    @endif
                                    @if($row->status == 0)
                                        <td class="text-danger">{{ __('Inactive') }}</td>
                                    @endif
                                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                {{ __('Action') }}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon"
                                                   href="{{ route('admin.pages.edit', $row->id) }}"><i class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $pages->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


