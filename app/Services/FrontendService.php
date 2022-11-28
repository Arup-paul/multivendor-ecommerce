<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FrontendService
{

    public function  createUpdateDeliveryAddress($request,$deliveryAddress){
        $deliveryAddress->user_id = Auth::id();
        $deliveryAddress->name = $request->name;
        $deliveryAddress->email = $request->email;
        $deliveryAddress->mobile = $request->mobile;
        $deliveryAddress->address = $request->address;
        $deliveryAddress->city = $request->city;
        $deliveryAddress->state = $request->state;
        $deliveryAddress->country = $request->country;
        $deliveryAddress->zip = $request->zip;
        $deliveryAddress->address_type = $request->address_type;
        $deliveryAddress->status = 1;
    }

}
