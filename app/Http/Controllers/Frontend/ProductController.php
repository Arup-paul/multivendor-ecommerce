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


                $products = Product::with('category','category.subcategories','brand')->whereIn('category_id', $categoryId)->where('status', 1);
                if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == 'latest') {
                        $products = $products->orderBy('id', 'desc');
                    } elseif ($_GET['sort'] == 'lowest-price') {
                        $products = $products->orderBy('product_price', 'asc');
                    } elseif ($_GET['sort'] == 'highest-price') {
                        $products = $products->orderBy('product_price', 'desc');
                    } elseif ($_GET['sort'] == 'name-a-z') {
                        $products = $products->orderBy('product_name', 'asc');
                    } elseif ($_GET['sort'] == 'name-z-a') {
                        $products = $products->orderBy('product_name', 'desc');
                    }
                } else {
                    $products = $products->orderBy('id', 'desc');
                }
                 $products = $products->paginate(20);
                return view('frontend.products.listing', compact('products', 'breadCrumb','parentCategory'));
            } else {
                abort(404);
            }

      }
}
