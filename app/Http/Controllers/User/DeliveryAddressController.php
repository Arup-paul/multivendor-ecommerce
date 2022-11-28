<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryAddressRequest;
use App\Models\DeliveryAddress;
use App\Services\FrontendService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryAddressController extends Controller
{
    public function create(){
        return view('frontend.user.delivery_address.create');
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
        $auth = $deliveryAddress->user_id == auth()->id();
        if(!$auth){
            abort(404);
        }
        return view('frontend.user.delivery_address.edit',compact('deliveryAddress'));
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
