<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected  $table = 'delivery_addresses';

    public static function getDeliveryAddress()
    {
        return DeliveryAddress::where('user_id',auth()->user()->id)->get();
    }

    public static function getShippingCharge($total_weight,$country)
    {
        $shippingChargeData = DB::table('shipping_charges')
            ->where('country',$country)
            ->first();
        if($total_weight < 0){
            $shippingCharge = 0;
        }else{
            if($total_weight > 0 && $total_weight <= 500){
                $shippingCharge = $shippingChargeData->zero_fiveHundred;
            }elseif($total_weight > 500 && $total_weight <= 1000){
                $shippingCharge = $shippingChargeData->fiveHundredOne_oneThousand;
            }elseif($total_weight > 1000 && $total_weight <= 2000){
                $shippingCharge = $shippingChargeData->oneThousandOne_twoThousand;
            }elseif($total_weight > 2000 && $total_weight <= 5000){
                $shippingCharge = $shippingChargeData->twoThousandOne_fiveThousand;
            }else{
                $shippingCharge = $shippingChargeData->above_FiveThousand;
            }
        }

        return $shippingCharge;
    }

}
