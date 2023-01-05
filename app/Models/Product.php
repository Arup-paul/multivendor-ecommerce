<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        return $this->belongsTo(Vendor::class)->where('status',1)->with('vendorDetails');
    }
    public function owner()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }






    public function attributes()
    {
        return $this->hasMany(ProductAttributes::class,'product_id')->where('status',1);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id')->where('status',1);
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
            $discountPrice = 0;
        }
        return number_format($discountPrice);
    }

    public static function getDisCountAttributePrice($product_id,$size){
        $productAttribute = ProductAttributes::where('product_id',$product_id)->where('size',$size)->first();

        $product = Product::select(['product_price','product_discount','category_id'])
            ->where('id',$product_id)
            ->first();
        $category = Category::select(['category_discount'])
            ->where('id',$product->category_id)
            ->first();

        if($product->product_discount > 0){
            $total_price = $productAttribute->price - ($productAttribute->price * ($product->product_discount/100));
        }elseif($category->category_discount > 0){
            $total_price = $productAttribute->price - ($productAttribute->price * ($category->category_discount/100));
        }else{
            $total_price = $productAttribute->price;
        }
        return [
            'total_price' => number_format($total_price),
            'discount_price' => number_format($productAttribute->price - $total_price),
            'product_price' => number_format($productAttribute->price),
            'sku' => $productAttribute->sku,
        ];
    }

    //get product stock
    public static function getProductStock($product_id,$size){
        $productAttribute = ProductAttributes::where('product_id',$product_id)->where('size',$size)->first();
        return $productAttribute->stock;
    }

    public static function updateProductStock($product_id,$size,$quantity){
        $productAttribute = ProductAttributes::where('product_id',$product_id)->where('size',$size)->first();
        $productAttribute->stock = $productAttribute->stock - $quantity;
        $productAttribute->save();
    }

    //get product attributes
    public static function getProductAttribute($product_id,$size){
        $productAttribute = ProductAttributes::where('product_id',$product_id)->where('size',$size)->where('status',1)->count();
        return $productAttribute;
    }

    //get category status
    public static function getCategoryStatus($category_id){
        $category = Category::select(['status'])->where('id',$category_id)->first();
        return $category->status;
    }




}
