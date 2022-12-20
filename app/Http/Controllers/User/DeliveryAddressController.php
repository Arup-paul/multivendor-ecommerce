<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryAddressRequest;
use App\Models\DeliveryAddress;
use App\Models\ShippingCharge;
use App\Services\FrontendService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryAddressController extends Controller
{

    public function index(){
        $deliveryAddress = DeliveryAddress::getDeliveryAddress();
        return view('frontend.user.delivery_address.index',compact('deliveryAddress'));
    }
    public function create(){
        $countries = ShippingCharge::whereStatus(1)->get();
        return view('frontend.user.delivery_address.create',compact('countries'));
    }

    public function store(DeliveryAddressRequest $request){

            $deliveryAddress = new DeliveryAddress();
            $frontendService = new FrontendService();
            $frontendService->createUpdateDeliveryAddress($request,$deliveryAddress);
            $deliveryAddress->save();

            return response()->json([
                'message' => 'Delivery Address Created Successfully',
            ]);

    }

    public function edit($id){
        $deliveryAddress = DeliveryAddress::findOrFail($id);
        $countries = ShippingCharge::whereStatus(1)->get();

        $auth = $deliveryAddress->user_id == auth()->id();
        if(!$auth){
            abort(404);
        }
        return view('frontend.user.delivery_address.edit',compact('deliveryAddress','countries'));
    }

    public function update(DeliveryAddressRequest $request,$id){
           $deliveryAddress = DeliveryAddress::findOrFail($id);
            $auth = $deliveryAddress->user_id == auth()->id();
            if(!$auth){
                abort(404);
            }
            $frontendService = new FrontendService();
            $frontendService->createUpdateDeliveryAddress($request,$deliveryAddress);
            $deliveryAddress->save();

            return response()->json([
                'message' => 'Delivery Address updated Successfully',
            ]);

    }
}
