@extends('admin.layout.layout', [
   'prev'=> url()->previous()
])

@section('title',__('Vendor Details'))

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Personal Information') }}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-center flex-column">
                        <figure class="avatar avatar-lg">
                            <img
                                src="{{ $admin->avatar ? asset($admin->avatar) : get_gravatar($admin->email) }}"
                                alt="{{ $admin->name }}"
                            >
                        </figure>

                        <h3 class="  mx-auto">{{ $admin->name }}</h3>

                        <ul class="list-group mt-4">
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('User Type') }}</div>
                                <div class="font-weight-light"><span></span>{{ $admin->type }}</div>
                            </li>
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Mobile') }}</div>
                                <div class="font-weight-light"><span></span>{{ $admin->mobile }}</div>
                            </li>
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Email') }}</div>
                                <div class="font-weight-light">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#sendEmailModal">
                                        {{ $admin->email }} <i class="fas fa-paper-plane"></i>
                                    </a>
                                </div>
                            </li>

                            @if(isset($admin->vendor->address))
                                <li class="list-group-item">
                                    <div class="font-weight-bolder">{{ __('Address') }}</div>
                                    <div class="font-weight-light"><span></span>{{ $admin->vendor->address ?? '' }}</div>
                                </li>
                            @endif

                            @if(isset($admin->vendor->city))
                                <li class="list-group-item">
                                    <div class="font-weight-bolder">{{ __('City') }}</div>
                                    <div class="font-weight-light"><span></span>{{ $admin->vendor->city ?? '' }}</div>
                                </li>
                            @endif
                            @if(isset($admin->vendor->state))
                                <li class="list-group-item">
                                    <div class="font-weight-bolder">{{ __('City') }}</div>
                                    <div class="font-weight-light"><span></span>{{ $admin->vendor->state ?? '' }}</div>
                                </li>
                            @endif
                            @if(isset($admin->vendor->country))
                                <li class="list-group-item">
                                    <div class="font-weight-bolder">{{ __('City') }}</div>
                                    <div class="font-weight-light"><span></span>{{ $admin->vendor->country ?? '' }}</div>
                                </li>
                            @endif
                            @if(isset($admin->vendor->pincode))
                                <li class="list-group-item">
                                    <div class="font-weight-bolder">{{ __('City') }}</div>
                                    <div class="font-weight-light"><span></span>{{ $admin->vendor->pincode ?? '' }}</div>
                                </li>
                            @endif

                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Account Status') }}</div>
                                <div class="font-weight-light">
                                    @if($admin->status == 1)
                                        <span class="badge badge-primary">{{ __('Active') }}</span>
                                    @elseif($admin->status == 0)
                                        <span class="badge badge-warning">{{ __('Inactive') }}</span>
                                    @endif
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Bank Details') }}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-center flex-column">

                        <ul class="list-group">

                            @if(isset($admin->vendorBank->account_holder_name))
                                <li class="list-group-item">
                                    <div class="font-weight-bolder">{{ __('Account Holder Name') }}</div>
                                    <div class="font-weight-light"><span></span>{{ $admin->vendorBank->account_holder_name ?? '' }}</div>
                                </li>
                            @endif
                                @if(isset($admin->vendorBank->account_number))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Account Number') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBank->account_number ?? '' }}</div>
                                    </li>
                                @endif
                                @if(isset($admin->vendorBank->bank_name))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Bank Name') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBank->bank_name ?? '' }}</div>
                                    </li>
                                @endif
                                @if(isset($admin->vendorBank->bank_ifsc_code))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Bank IFSC Code') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBank->bank_ifsc_code ?? '' }}</div>
                                    </li>
                                @endif




                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Business Details') }}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-center flex-column">

                        <ul class="list-group mt-4">

                            @if(isset($admin->vendorBusiness->shop_name))
                                <li class="list-group-item">
                                    <div class="font-weight-bolder">{{ __('Shop Name') }}</div>
                                    <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->shop_name ?? '' }}</div>
                                </li>
                            @endif

                                @if(isset($admin->vendorBusiness->shop_city))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Shop City') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->shop_city ?? '' }}</div>
                                    </li>
                                @endif

                                @if(isset($admin->vendorBusiness->shop_country))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Shop Country') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->shop_country ?? '' }}</div>
                                    </li>
                                @endif

                                @if(isset($admin->vendorBusiness->shop_pincode))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Shop Pin Code') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->shop_pincode ?? '' }}</div>
                                    </li>
                                @endif
                                @if(isset($admin->vendorBusiness->shop_mobile))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Shop Mobile') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->shop_mobile ?? '' }}</div>
                                    </li>
                                @endif
                                @if(isset($admin->vendorBusiness->shop_website))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Shop Website') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->shop_website ?? '' }}</div>
                                    </li>
                                @endif

                                @if(isset($admin->vendorBusiness->shop_website))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Shop Website') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->shop_website ?? '' }}</div>
                                    </li>
                                @endif

                                @if(isset($admin->vendorBusiness->address_proof))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Address Proof ') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->address_proof ?? '' }}</div>
                                    </li>
                                @endif

                                @if(isset($admin->vendorBusiness->address_proof_image))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Address Proof Image') }}</div>
                                       <img src="{{asset($admin->vendorBusiness->address_proof_image)}}" alt="" width="200" height="200">
                                    </li>
                                @endif

                                @if(isset($admin->vendorBusiness->business_license_number))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Business License Number ') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->business_license_number ?? '' }}</div>
                                    </li>
                                @endif

                                @if(isset($admin->vendorBusiness->pan_number))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Pan Number ') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->pan_number ?? '' }}</div>
                                    </li>
                                @endif

                                @if(isset($admin->vendorBusiness->gst_number))
                                    <li class="list-group-item">
                                        <div class="font-weight-bolder">{{ __('Pan Number ') }}</div>
                                        <div class="font-weight-light"><span></span>{{ $admin->vendorBusiness->gst_number ?? '' }}</div>
                                    </li>
                                @endif


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalTitle">{{ __('Send Email') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action=" " method="POST" class="ajaxform_with_reset">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="subject" class="required">{{ __('Subject') }}</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('Enter email subject') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="message" class="required">{{ __('Message') }}</label>
                            <textarea name="message" id="message" class="form-control" style="height: 150px" placeholder="{{ __('Enter message') }}" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary basicbtn">
                            <i class="fas fa-paper-plane"></i>
                            {{ __('Send') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

