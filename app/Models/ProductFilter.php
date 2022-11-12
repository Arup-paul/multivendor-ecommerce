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

    public static function getSizes($url){
        $category = Category::getCategory($url);

        $getProductIds = Product::whereIn('category_id',$category)
            ->whereStatus(1)
            ->pluck('id');

        $getProductSizes = ProductAttributes::whereIn('product_id',$getProductIds)
            ->whereStatus(1)
            ->groupBy('size')
            ->pluck('size');

        return $getProductSizes;
    }

    public static function getColors($url){
        $category = Category::getCategory($url);

        $getProductIds = Product::whereIn('category_id',$category)
            ->whereStatus(1)
            ->pluck('id');

        $getColors = Product::whereIn('id',$getProductIds)
            ->whereStatus(1)
            ->groupBy('product_color')
            ->pluck('product_color');


        return $getColors;
    }

    public static function getBrands($url){
        $category = Category::getCategory($url);

        $getProductIds = Product::whereIn('category_id',$category)
            ->whereStatus(1)
            ->pluck('id');

        $getBrandId = Product::whereIn('id',$getProductIds)
            ->whereStatus(1)
            ->groupBy('brand_id')
            ->pluck('brand_id');

        $getBrands = Brand::whereIn('id',$getBrandId)
            ->whereStatus(1)
            ->get(['name','id']);


        return $getBrands;
    }





}
