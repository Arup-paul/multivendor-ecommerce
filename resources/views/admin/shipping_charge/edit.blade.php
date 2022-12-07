@extends('admin.layout.layout',[
    'prev' => route('admin.shipping-charge.index')
])

@section('title', 'Update Shipping Charge')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body overflow-auto" >
                        <form method="POST" action="{{route('admin.shipping-charge.update',$shippingCharge->id)}}" class="ajaxform"  >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Country Name') }} </label>
                                <input type="text" value="{{$shippingCharge->country}}"  name="country" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('0 to 500 GM Shipping Charge') }} </label>
                                <input type="text" value="{{$shippingCharge->zero_fiveHundred}}"   name="zero_fiveHundred" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('501 to 1000 GM Shipping Charge') }} </label>
                                <input type="text" value="{{$shippingCharge->fiveHundredOne_oneThousand}}"  name="fiveHundredOne_oneThousand" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('1001 to 2000 GM Shipping Charge') }} </label>
                                <input type="text" value="{{$shippingCharge->oneThousandOne_twoThousand}}"   name="oneThousandOne_twoThousand" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('2001 to 5000 GM Shipping Charge') }} </label>
                                <input type="text" value="{{$shippingCharge->twoThousandOne_fiveThousand}}"   name="twoThousandOne_fiveThousand" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Above 5000 GM Shipping Charge') }} </label>
                                <input type="text"  value="{{$shippingCharge->above_FiveThousand}}"  name="above_FiveThousand" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="password" class="required">{{ __('Status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1" @selected($shippingCharge->status == 1)>{{ __('Active') }}</option>
                                    <option value="0" @selected($shippingCharge->status == 0)>{{ __('Inactive') }}</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary float-right basic-btn"  >
                                    <i class="fas fa-save"> </i>
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

