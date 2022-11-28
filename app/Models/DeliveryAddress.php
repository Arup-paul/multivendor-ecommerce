<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected  $table = 'delivery_addresses';

    public static function getDeliveryAddress()
    {
        return DeliveryAddress::where('user_id',auth()->user()->id)->get();
    }

}
