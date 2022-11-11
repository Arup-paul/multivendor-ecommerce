<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilterValue extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function filterValues(){
        return $this->belongsTo(ProductFilter::class,'product_filter_id','id');
    }
}
