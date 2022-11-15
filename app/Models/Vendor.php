<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vendorDetails(){
        return $this->belongsTo(VendorsBusinessDetail::class,'id','vendor_id');
    }
}
