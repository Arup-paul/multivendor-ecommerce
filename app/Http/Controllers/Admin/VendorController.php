<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use DB;

class VendorController extends Controller
{
    public function index(Request $request){
        $vendors = Admin::query()
            ->where('type', '=', 'vendor')
            ->when($request->get('status')  != null, function (Builder $query) use ($request) {
                $query->where('status', '=', $request->get('status'));
            })
            ->latest()
            ->paginate(10);


        $all = Admin::where('type', '=', 'vendor')->get();
        $active = Admin::where('type', '=', 'vendor')->whereStatus(1)->get();
        $inactive = Admin::where('type', '=', 'vendor')->whereStatus(0)->get();

        return view('admin.vendors.index',compact('vendors','all','active','inactive'));
    }
    public function updateVendorDetails(Request $request, $slug)
    {
        if ($slug == 'personal') {
            $vendorId = auth()->guard('admin')->user()->vendor_id;
            $vendorDetails = Vendor::where('id', $vendorId)->first()->toArray();
            if ($request->isMethod('post')) {
                //validation
                $request->validate([
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'mobile' => 'required|numeric|unique:vendors,mobile,' . $vendorDetails['id'],
                    'email' => 'required|email|unique:vendors,email,' . $vendorDetails['id'],
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
                    $vendor->status = 1;
                    $vendor->save();

                    $vendorAdmin = Admin::find(auth()->guard('admin')->user()->id);
                    $vendorAdmin->name = $data['name'];
                    $vendorAdmin->mobile = $data['mobile'];
                    $vendorAdmin->email = $data['email'];
                    $vendorAdmin->image = $data['preview'];
                    $vendorAdmin->save();

                    DB::commit();
                    return response()->json([
                        'message' => __('Vendor Personal Details Updated Successfully'),
                        'redirect' => url()->previous()
                    ]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(__('Something Went Wrong'), 401);
                }

            }
        } else if ($slug == 'business') {
            $vendorId = auth()->guard('admin')->user()->vendor_id;
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', $vendorId)->first();
            $vendorDetails = $vendorDetails ? $vendorDetails->toArray() : [];
            if ($request->isMethod('post')) {
                $data = $request->all();

                //validation
                $request->validate([
                    'shop_name' => 'required',
                    'shop_city' => 'required',
                    'shop_mobile' => 'required|numeric',
                    'address_proof' => 'required',
                    'adddress_proof_image' => 'required',
                ]);
                try {
                    $vendor = VendorsBusinessDetail::updateOrCreate(['vendor_id' => $vendorId], [
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

                    Vendor::find($vendorId)->update(['is_business_details' => 1]);


                    return response()->json([
                        'message' => __('Vendor Business Details Updated Successfully'),
                        'redirect' => url()->previous()
                    ]);
                } catch (\Exception $e) {
                    return response()->json(__('Something Went Wrong'), 401);
                }

            }

        } else if ($slug == 'bank') {
            $vendorId = auth()->guard('admin')->user()->vendor_id;
            $vendorDetails = VendorsBankDetail::where('vendor_id', $vendorId)->first();
            $vendorDetails = $vendorDetails ? $vendorDetails->toArray() : [];

            if ($request->isMethod('post')) {
                $data = $request->all();

                //validation
                $request->validate([
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'account_number' => 'required|numeric',
                    'bank_ifsc_code' => 'required',
                    'bank_name' => 'required',
                ]);
//                try {
                    VendorsBankDetail::updateOrCreate(['vendor_id' => $vendorId], [
                        'account_holder_name' => $data['account_holder_name'],
                        'account_number' => $data['account_number'],
                        'bank_name' => $data['bank_name'],
                        'bank_ifsc_code' => $data['bank_ifsc_code'],
                    ]);

                    return response()->json([
                        'message' => __('Vendor Bank Details Updated Successfully'),
                        'redirect' => url()->previous()
                    ]);
//                } catch (\Exception $e) {
//                    return response()->json(__('Something Went Wrong'), 401);
//                }


            }
        }

        $countries = Country::where('status', 1)->get();
        return view('admin.vendors.vendor_details', compact('slug', 'vendorDetails','countries'));
    }
}

