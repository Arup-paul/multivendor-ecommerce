@extends('admin.layout.layout', [
   'prev'=> url()->previous()
])

@section('title','Vendor '. ucfirst($slug) .' Details')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@section('content')
    <section class="section">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">

                    <div class="card-body" >
                        @if($slug == 'personal')
                        <form method="POST" action="{{route('admin.update-vendor-details','personal')}}" class="ajaxform"  >
                          @csrf

                            <div class="form-group">
                                <label for="name" class="required">Name</label>
                                <input type="text" name="name" id="name" class="form-control"  placeholder="Enter Name" value="{{$vendorDetails['name']}}" required="" >
                            </div>
                            <div class="form-group">
                                <label for="password" class="required">Email</label>
                                <input type="email" name="email"   class="form-control" placeholder="Enter Email" value="{{$vendorDetails['email']}}"  >
                            </div>
                            <div class="form-group">
                                <label for="mobile"  class="required" >Mobile</label>
                                <input type="mobile" name="mobile"   class="form-control" placeholder="Enter Mobile " value="{{$vendorDetails['mobile']}}"  >
                            </div>
                            <div class="form-group">
                                <label for="city" >City</label>
                                <input type="text" name="city" id="city" class="form-control"  placeholder="Enter City" value="{{$vendorDetails['city']}}"   >
                            </div>
                            <div class="form-group">
                                <label for="state"  >State </label>
                                <input type="text" name="state" id="state" class="form-control"  placeholder="Enter State" value="{{$vendorDetails['state']}}"   >
                            </div>
                            <div class="form-group">
                                <label for="country"  >Country</label>
                                <input type="text" name="country" id="country" class="form-control"  placeholder="Enter Country Name" value="{{$vendorDetails['country']}}"  >
                            </div>
                            <div class="form-group">
                                <label for="pincode"  >Pin Code</label>
                                <input type="text" name="pincode" id="pincode" class="form-control"  placeholder="Enter Pin Code " value="{{$vendorDetails['pincode']}}"  >
                            </div>

                            <div class="form-group">
                                <label for="address"  >Address</label>
                                <textarea name="address" class="form-control" id="" cols="30" rows="10">{{$vendorDetails['address']}}</textarea>
                            </div>

                                 {{ mediasection([
                                            'input_name' => 'preview',
                                             'input_id' => 'preview',
                                             'preview' => auth()->guard('admin')->user()->image ?? null,
                                             'value' => auth()->guard('admin')->user()->image ?? null,
                                         ]) }}

                            <div class="form-group">
                                <button class="btn btn-primary float-right basic-btn"  >
                                    <i class="fas fa-save"> </i>
                                    Save
                                </button>
                            </div>
                        </form>
                        @elseif($slug == 'business')
                            <form method="POST" action="{{route('admin.update-vendor-details','business')}}" class="ajaxform"  >
                                @csrf

                                <div class="form-group">
                                    <label for="shop_name" class="required">Shop Name</label>
                                    <input type="text" name="shop_name" id="shop_name" class="form-control"  placeholder="Enter Shop Name" value="{{$vendorDetails['shop_name'] ?? ''}}"   >
                                </div>
                                <div class="form-group">
                                    <label for="shop_address" >Shop Address</label>
                                    <input type="text" name="shop_address" id="shop_address" class="form-control"  placeholder="Enter Shop Address" value="{{$vendorDetails['shop_address'] ?? ''}}"   >
                                </div>

                                <div class="form-group">
                                    <label for="shop_city"  class="required" >Shop City</label>
                                    <input type="shop_city" name="shop_city"   class="form-control" placeholder="Enter Shop City" value="{{$vendorDetails['shop_city'] ?? ''}}"  >
                                </div>
                                <div class="form-group">
                                    <label for="shop_country" >Shop Country</label>
                                    <input type="text" name="shop_country" id="shop_country" class="form-control"  placeholder="Enter Shop Country" value="{{$vendorDetails['shop_country'] ?? ''}}"   >
                                </div>
                                <div class="form-group">
                                    <label for="shop_pincode"  >Shop Pincode </label>
                                    <input type="text" name="shop_pincode" id="shop_pincode" class="form-control"  placeholder="Enter Shop Pincode" value="{{$vendorDetails['shop_pincode'] ?? ''}}"   >
                                </div>
                                <div class="form-group">
                                    <label for="shop_mobile" class="required" >Shop Mobile Number</label>
                                    <input type="text" name="shop_mobile" id="shop_mobile" class="form-control"  placeholder="Enter Shop Mobile Number" value="{{$vendorDetails['shop_mobile'] ?? ''}}"  >
                                </div>

                                <div class="form-group">
                                    <label for="shop_website"  >Shop  Website</label>
                                    <input type="text" name="shop_website" id="shop_website" class="form-control"  placeholder="Enter Shop Website" value="{{$vendorDetails['shop_website'] ?? ''}}"  >
                                </div>

                                <div class="form-group">
                                    <label for="shop_email"  >Shop Email</label>
                                    <input type="text" name="shop_email" id="shop_email" class="form-control"  placeholder="Enter Shop Email" value="{{$vendorDetails['shop_email'] ?? ''}}"  >
                                </div>

                                <div class="form-group">
                                    <label for="address_proof" class="required"  >Shop Address Proof</label>
                                    <select class="form-control" name="address_proof" id="address_proof">
                                        <option value="">Select</option>
                                        <option value="passport" @selected($vendorDetails['address_proof'] == 'passport')>Passport</option>
                                        <option value="nid" @selected($vendorDetails['address_proof'] == 'nid') >NID Card</option>
                                        <option value="visa" @selected($vendorDetails['address_proof'] == 'visa') >Visa</option>
                                    </select>
                                 </div>

                                <label for="address_proof" class="required" >Address Proof Image</label>
                                {{ mediasection([
                                           'input_name' => 'adddress_proof_image',
                                            'input_id' => 'adddress_proof_image',
                                            'preview' =>  $vendorDetails['address_proof_image'] ?? null,
                                            'value' => $vendorDetails['address_proof_image'] ?? null,
                                        ]) }}

                                <div class="form-group">
                                    <label for="business_license_number"  >Business License Number</label>
                                    <input type="text" name="business_license_number" id="business_license_number" class="form-control"  placeholder="Enter Business License Number" value="{{$vendorDetails['business_license_number'] ?? ''}}"  >
                                </div>
                                <div class="form-group">
                                    <label for="gst_number"  >GST Number</label>
                                    <input type="text" name="gst_number" id="gst_number" class="form-control"  placeholder="Enter GST Number" value="{{$vendorDetails['gst_number'] ?? ''}}"  >
                                </div>

                                <div class="form-group">
                                    <label for="pan_number"  >Pan Number</label>
                                    <input type="text" name="pan_number" id="pan_number" class="form-control"  placeholder="Enter Pan NUmber" value="{{$vendorDetails['pan_number'] ?? ''}}"  >
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary float-right basic-btn"  >
                                        <i class="fas fa-save"> </i>
                                        Save
                                    </button>
                                </div>
                            </form>

                        @elseif($slug == 'bank')
                            bank
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{ mediasingle() }}
@endsection
@push('script')
    <script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/media.js') }}"></script>
@endpush

