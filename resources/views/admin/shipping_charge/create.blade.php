@extends('admin.layout.layout',[
    'prev' => route('admin.shipping-charge.index')
])

@section('title', 'Add New Shipping Charge')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body "  >
                        <form method="POST" action="{{route('admin.shipping-charge.store')}}" class="ajaxform_with_reset"  >
                            @csrf
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Country Name') }} </label>
                                <input type="text"  name="country" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('0 to 500 GM Shipping Charge') }} </label>
                                <input type="text"  name="zero_fiveHundred" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('501 to 1000 GM Shipping Charge') }} </label>
                                <input type="text"  name="fiveHundredOne_oneThousand" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('1001 to 2000 GM Shipping Charge') }} </label>
                                <input type="text"  name="oneThousandOne_twoThousand" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('2001 to 5000 GM Shipping Charge') }} </label>
                                <input type="text"  name="twoThousandOne_fiveThousand" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="name" class="required">{{ __('Above 5000 GM Shipping Charge') }} </label>
                                <input type="text"  name="above_FiveThousand" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="password" class="required">{{ __('Status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Inactive') }}</option>
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

