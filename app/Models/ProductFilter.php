<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function filterValues(){
        return $this->hasMany(ProductFilterValue::class,'product_filter_id','id');
    }

    public static function getFilter(){
        $productFilters = ProductFilter::with('filterValues')->where('status',1)->get();

        return $productFilters;
    }

    public static function filterAvailable($filter_id,$categoryId){
        $filterAvailable = ProductFilter::select('category_id')->whereId($filter_id)->whereStatus(1)->first();
        $categoryIdArray = explode(',',$filterAvailable->category_id);

        if(in_array($categoryId,$categoryIdArray)) {
            return true;
        }else{
            return false;
        }
    }



}
