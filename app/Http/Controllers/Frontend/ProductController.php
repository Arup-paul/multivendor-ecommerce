<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductFilter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
      public function listing(Request $request){

          if($request->ajax()){
              $url = $request->input('url');
              $sort = $request->input('sort');
              $size = $request->input('size');


          }else{
              $url = request()->segment(1);
          }

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

               //check dynamic filter
                if($request->ajax()) {
                    $productFilters = ProductFilter::getFilter();
                    foreach ($productFilters as $key => $filter) {
                        if (isset($filter->filter_column) && isset($request[$filter->filter_column]) &&
                            !empty($filter->filter_column) && !empty($request[$filter->filter_column])) {
                            $products->whereIn($filter->filter_column, $request[$filter->filter_column]);
                        }
                    }

                    if(isset($size) && !empty($size)){
                        $products->whereHas('attributes',function ($query) use ($size){
                            $query->whereIn('size',$size);
                        });
                    }
                }


                if(isset($sort) && !empty($sort)) {
                    if ($sort == 'latest') {
                        $products = $products->orderBy('id', 'desc');
                    } elseif ($sort == 'lowest-price') {
                        $products = $products->orderBy('product_price', 'asc');
                    } elseif ($sort == 'highest-price') {
                        $products = $products->orderBy('product_price', 'desc');
                    } elseif ($sort == 'name-a-z') {
                        $products = $products->orderBy('product_name', 'asc');
                    } elseif ($sort == 'name-z-a') {
                        $products = $products->orderBy('product_name', 'desc');
                    }
                } else {
                    $products = $products->orderBy('id', 'desc');
                }
                 $products = $products->paginate(20);

                if($request->ajax()){
                    return view('frontend.products.ajax_listing',compact('products'));
                }else{
                    return view('frontend.products.listing', compact('products', 'breadCrumb','parentCategory','url','category'));
                }

            } else {
                abort(404);
            }

      }
}
