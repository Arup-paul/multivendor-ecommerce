@extends('admin.layout.layout',[
    'prev' => route('admin.coupons.index')
])

@section('title', 'Add New Coupon')

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body "  >
                        <form method="POST" action="{{route('admin.coupons.store')}}" class="ajaxform"  >
                            @csrf
                            <div class="form-group">
                                <label for="coupon_option" class="required">{{ __('Coupon Option:') }} </label>
                                <span><input type="radio" id="AutomaticCoupon"  name="coupon_option" value="Automatic" > {{ __('Automatic') }} &nbsp;</span>
                                <span><input type="radio" id="ManualCoupon"  name="coupon_option" value="Manual" > {{ __('Manual') }}</span>
                            </div>

                            <div class="form-group d-none" id="couponField">
                                <label for="coupon_code">{{ __('Coupon Code') }} </label>
                                <input type="text" class="form-control" name="coupon_code">
                            </div>
                            <div class="form-group">
                                <label for="coupon_type" class="required">{{ __('Coupon Type:') }} </label>
                                <span><input type="radio"  name="coupon_type" value="multiple times" > {{ __('Multiple Time') }} &nbsp;</span>
                                <span><input type="radio"  name="coupon_type" value="single time" >  {{ __('Single Time') }} </span>
                            </div>

                            <div class="form-group">
                                <label for="amount_type" class="required">{{ __('Amount Type:') }} </label>
                                <span><input type="radio"  name="amount_type" value="Percentage" > {{ __('Percentage') }} &nbsp;</span>
                                <span><input type="radio"  name="amount_type" value="Fixed" >  {{ __('Fixed') }} </span>
                            </div>
                            <div class="form-group">
                                <label for="amount">{{ __('Amount') }} </label>
                                <input type="number" class="form-control" name="amount">
                            </div>
                            <div class="form-group">
                                <label for="category_id">{{ __('Category (all category eligible for if you not select any category)') }} </label>
                                <select name="categories[]" id="category_id" class="form-control select2" multiple="" >
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @foreach($category->subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}">  &nbsp;&nbsp; -- {{$subcategory->category_name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="users">{{ __('Users (all users eligible for if you not select any users)') }} </label>
                                <select name="users[]" id="users" class="form-control select2" multiple="" >
                                    <option value="">{{ __('Select Users') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_date">{{ __('Start Date') }} </label>
                                <input type="date" class="form-control" name="start_date">
                            </div>

                            <div class="form-group">
                                <label for="end_date">{{ __('End Date') }} </label>
                                <input type="date" class="form-control" name="end_date">
                            </div>

                            <div class="form-group">
                                <label for="status" class="required">{{ __('Status') }}</label>
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

@push('script')
    <script>
       $("#ManualCoupon").on('click',function (){
           $("#couponField").removeClass('d-none');

       });
       $("#AutomaticCoupon").click(function (){
           $("#couponField").addClass('d-none');
       })
    </script>
@endpush()

