<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class,'order_id');
    }

    public function deliveryAddress(){
        return $this->belongsTo(DeliveryAddress::class,'delivery_address_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
