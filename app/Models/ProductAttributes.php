<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static  function isStockAvailable($product_id,$size){
        $productAttr = ProductAttributes::where('product_id',$product_id)->where('size',$size)->first();

        return $productAttr->stock;
    }

}
