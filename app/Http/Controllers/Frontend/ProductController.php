<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
      public function listing(){
          $url = request()->segment(1);
          $category =  Category::with('subcategories')->whereUrl($url)->whereStatus(1)->select(['parent_id','category_name','url','id','category_image','description'])->first();
            if($category) {

               if($category->parent_id == null){
                   $breadCrumb = $category;
                   $parentCategory = [];
               }else{
                     $parentCategory = Category::where('id',$category->parent_id)->first();
                     $breadCrumb =  $category;
               }

               $categoryId = [];
               $categoryId[] = $category->id;
               foreach ($category->subcategories as $subcategory) {
                  $categoryId[] = $subcategory->id;
                }


                $products = Product::with('category','category.subcategories','brand')->whereIn('category_id', $categoryId)->where('status', 1)->paginate(20);
                return view('frontend.products.listing', compact('products', 'breadCrumb','parentCategory'));
            } else {
                abort(404);
            }

      }
}
