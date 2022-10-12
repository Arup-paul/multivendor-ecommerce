<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use Illuminate\Http\Request;
use DB;

class VendorController extends Controller
{
    public function updateVendorDetails(Request $request, $slug){
        if($slug == 'personal'){
            $vendorId =auth()->guard('admin')->user()->vendor_id;
            $vendorDetails = Vendor::where('id',$vendorId)->first()->toArray();
            if($request->isMethod('post')){
                //validation
                $request->validate([
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'mobile' => 'required|numeric|unique:vendors,mobile,'.$vendorDetails['id'],
                    'email' => 'required|email|unique:vendors,email,'.$vendorDetails['id'],
                ]);
                DB::beginTransaction();
                try {
                    $data = $request->all();
                    $vendor = Vendor::find($vendorId);
                    $vendor->name = $data['name'];
                    $vendor->mobile = $data['mobile'];
                    $vendor->email = $data['email'];
                    $vendor->city = $data['city'];
                    $vendor->state = $data['state'];
                    $vendor->country = $data['country'];
                    $vendor->address = $data['address'];
                    $vendor->pincode = $data['pincode'];
                    $vendor->save();

                    $vendorAdmin = Admin::find(auth()->guard('admin')->user()->id);
                    $vendorAdmin->name = $data['name'];
                    $vendorAdmin->mobile = $data['mobile'];
                    $vendorAdmin->email = $data['email'];
                    $vendorAdmin->image = $data['preview'];
                    $vendorAdmin->save();

                    DB::commit();
                    return  response()->json([
                        'message' => __('Vendor Personal Details Updated Successfully'),
                        'redirect' => url()->previous()
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return  response()->json(  __('Something Went Wrong'), 401 );
                }

            }
        }else if($slug == 'business'){
            $vendorId =auth()->guard('admin')->user()->vendor_id;
            $vendorDetails = VendorsBusinessDetail::where('vendor_id',$vendorId)->first();
            $vendorDetails = $vendorDetails ? $vendorDetails->toArray() : [];
            if($request->isMethod('post')){
                $data = $request->all();


                //validation
                $request->validate([
                    'shop_name' => 'required',
                    'shop_city' => 'required',
                    'shop_mobile' => 'required|numeric',
                    'address_proof' => 'required',
                    'adddress_proof_image' => 'required',
                ]);
//                try {
                    $vendor = VendorsBusinessDetail::updateOrCreate(['vendor_id' => $vendorId],[
                        'shop_name' => $data['shop_name'],
                        'shop_address' => $data['shop_address'],
                        'shop_city' => $data['shop_city'],
                        'shop_country' => $data['shop_country'],
                        'shop_pincode' => $data['shop_pincode'],
                        'shop_mobile' => $data['shop_mobile'],
                        'shop_website' => $data['shop_website'],
                        'shop_email' => $data['shop_email'],
                        'address_proof' => $data['address_proof'],
                        'address_proof_image' => $data['adddress_proof_image'],
                        'business_license_number' => $data['business_license_number'],
                        'gst_number' => $data['gst_number'],
                        'pan_number' => $data['pan_number'],
                    ]);
//                    $vendor->shop_name = $data['shop_name'];
//                    $vendor->shop_address = $data['shop_address'];
//                    $vendor->shop_city = $data['shop_city'];
//                    $vendor->shop_country = $data['shop_country'];
//                    $vendor->shop_pincode = $data['shop_pincode'];
//                    $vendor->shop_mobile = $data['shop_mobile'];
//                    $vendor->shop_email = $data['shop_email'];
//                    $vendor->shop_website = $data['shop_website'];
//                    $vendor->address_proof = $data['address_proof'];
//                    $vendor->address_proof_image = $data['adddress_proof_image'];
//                    $vendor->business_license_number = $data['business_license_number'];
//                    $vendor->gst_number = $data['gst_number'];
//                    $vendor->pan_number = $data['pan_number'];
//                    $vendor->save();

                    return  response()->json([
                        'message' => __('Vendor Business Details Updated Successfully'),
                        'redirect' => url()->previous()
                    ]);
//                } catch (\Exception $e) {
//                    return  response()->json(  __('Something Went Wrong'), 401 );
//                }

            }

        }else if($slug == 'bank'){

        }
        return view('admin.vendors.vendor_details',compact('slug','vendorDetails'));
    }
}
