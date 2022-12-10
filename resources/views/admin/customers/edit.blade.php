@extends('admin.layout.layout', [
    'prev'=> route('admin.customers.index')
])

@section('title','User ')

@section('content')
    <section class="section">
        <div class="row mb-none-30">
            <div class="col-lg-8 offset-lg-2 mb-30">
                <div class="card b-radius-10 overflow-hidden box-shadow1">
                    <div class="card-body">
                        <h5 class="mb-20 text-muted">{{ __('User Via') }} {{$customer->name}}</h5>

                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __('Registered At') }} <span class="font-weight-bold">{{ date('d M y', strtotime($customer->created_at)) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __('Email') }} <span class="font-weight-bold">{{ $customer->email  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ __('Mobile ') }} <span class="font-weight-bold">{{ $customer->mobile  }}</span>
                            </li>



                            <form method="post" class="ajaxform"
                                  action="{{route('admin.customers.update',$customer->id)}}">
                                @csrf
                                @method('PUT')
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ __('Status') }} <span class="font-weight-bold">
                                    <select class="form-control " name="status">
                                       <option value="1" {{$customer->status == 1 ? 'selected' : ''}}>{{ __('Active') }}</option>
                                       <option value="0" {{$customer->status == 0 ? 'selected' : ''}}>{{ __('Inactive') }}</option>
                                    </select>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary col-12   basicbtn" type="submit">{{ __('Update') }}</button>
                                </li>
                            </form>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection

