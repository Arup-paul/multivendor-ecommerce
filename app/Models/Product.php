<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class)->select(['id','name']);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class)->select(['id','name']);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class)->select(['id','name']);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttributes::class,'product_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public static function getDiscountPrice($product_id){
        $product = Product::select(['product_price','product_discount','category_id'])
            ->where('id',$product_id)
            ->first();
       $category = Category::select(['category_discount'])
            ->where('id',$product->category_id)
            ->first();
        $discountPrice = 0;
        if($product->product_discount > 0){
            $discountPrice = $product->product_price - ($product->product_price * ($product->product_discount/100));
        }elseif($category->category_discount > 0){
            $discountPrice = $product->product_price - ($product->product_price * ($category->category_discount/100));
        }else{
            $discountPrice = $product->product_price;
        }
        return number_format($discountPrice);
    }


}
