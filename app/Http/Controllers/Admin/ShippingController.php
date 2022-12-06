<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        $shippingCharges = ShippingCharge::paginate(20);
        return view('admin.shipping_charge.index',compact('shippingCharges'));
    }

    public function create()
    {
        return view('admin.shipping_charge.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'shipping_charge' => 'required|numeric',
        ]);

        $data = new ShippingCharge();
        $data->country = $request->country;
        $data->shipping_charge = $request->shipping_charge;
        $data->status = $request->status;
        $data->save();

        return response()->json( [ 'message' =>  'Shipping Charge created successfully'] );
    }

    public function edit($id)
    {
        $shippingCharge = ShippingCharge::findOrFail($id);
        return view('admin.shipping_charge.edit',compact('shippingCharge'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'country' => 'required',
            'shipping_charge' => 'required|numeric',
        ]);

        $data = ShippingCharge::findOrFail($id);
        $data->country = $request->country;
        $data->shipping_charge = $request->shipping_charge;
        $data->status = $request->status;
        $data->save();

        return response()->json( [ 'message' =>  'Shipping Charge updated successfully'] );
    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $brand = ShippingCharge::findOrFail($id);
                    $brand->delete();
                }
                return response()->json([
                    'message' =>  __('Shipping Charge Deleted Successfully'),
                    'redirect' => route('admin.shipping-charge.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }




    }
}
