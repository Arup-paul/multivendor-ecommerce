<?php

namespace App\Services;

class ShippingService
{
   public function shippingChargeCreateUpdate($request, $shippingCharge){
       $shippingCharge->country = $request->country;
       $shippingCharge->zero_fiveHundred = $request->zero_fiveHundred;
       $shippingCharge->fiveHundredOne_oneThousand = $request->fiveHundredOne_oneThousand;
       $shippingCharge->oneThousandOne_twoThousand = $request->oneThousandOne_twoThousand;
       $shippingCharge->twoThousandOne_fiveThousand = $request->twoThousandOne_fiveThousand;
       $shippingCharge->above_FiveThousand = $request->above_FiveThousand;
       $shippingCharge->status = $request->status;
   }


}
