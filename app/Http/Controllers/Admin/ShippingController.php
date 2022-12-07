<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingChargeRequest;
use App\Models\ShippingCharge;
use App\Services\ShippingService;
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

    public function store(ShippingChargeRequest $request)
    {

        $data = new ShippingCharge();
        $shippingCharge = new ShippingService();
        $shippingCharge->shippingChargeCreateUpdate($request, $data);
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
            'country' =>  'required|unique:shipping_charges,country,'.$id,
            'zero_fiveHundred' => 'required|numeric',
            'fiveHundredOne_oneThousand' => 'required|numeric',
            'oneThousandOne_twoThousand' => 'required|numeric',
            'twoThousandOne_fiveThousand' => 'required|numeric',
            'above_FiveThousand' => 'required|numeric',
        ]);
        $data = ShippingCharge::findOrFail($id);
        $shippingCharge = new ShippingService();
        $shippingCharge->shippingChargeCreateUpdate($request, $data);
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
