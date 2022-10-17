<?php

namespace App\Services;

use App\Models\Category;

class ProductService
{
   public function productCreateUpdate($request, $product){

       $product->product_name = $request->product_name;
       $product->product_color = $request->product_color;
       $product->product_price = $request->product_price;
       $product->product_discount = $request->product_discount;
       $product->product_code = $request->product_code;
       $product->product_weight = $request->product_weight;
       $product->product_image = $request->product_image;
       $product->brand_id = $request->brand_id;
       $product->category_id = $request->category_id;

       $product->section_id = Category::find($request->category_id)->section_id;

       $product->admin_type = auth('admin')->user()->type;

       if(auth('admin')->user()->type == 'vendor'){
           $product->vendor_id = auth('admin')->user()->vendor_id;
       }else{
           $product->vendor_id = null;
       }

       $product->description = $request->description;
       $product->meta_title = $request->meta_title;
       $product->meta_keywords = $request->meta_keywords;
       $product->meta_description = $request->meta_description;
       $product->featured = $request->featured;
       $product->status = $request->status;

   }

}
