<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductFilter;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
      public function listing(Request $request){

          if($request->ajax()){
              $url = $request->input('url');
              $sort = $request->input('sort');
              $size = $request->input('size');
              $product_color = $request->input('product_color');
              $price_from = $request->input('price_from');
              $price_to = $request->input('price_to');
              $brand = $request->input('brand');

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


                if($request->ajax()) {
                    //check dynamic filter
                    $productFilters = ProductFilter::getFilter();
                    foreach ($productFilters as $key => $filter) {
                        if (isset($filter->filter_column) && isset($request[$filter->filter_column]) &&
                            !empty($filter->filter_column) && !empty($request[$filter->filter_column])) {
                            $products->whereIn($filter->filter_column, $request[$filter->filter_column]);
                        }
                    }

                    //size wise filtering
                    if(isset($size) && !empty($size)){
                        $products->whereHas('attributes',function ($query) use ($size){
                            $query->whereIn('size',$size);
                        });
                    }
                    //color wise filtering
                    if(isset($product_color) && !empty($product_color)){
                        $products->whereIn('product_color',$product_color);
                    }
                    //price wise filtering
                    if(isset($price_from) && !empty($price_from)){
                        $products->where('product_price','>=',$price_from);
                    }
                    if(isset($price_to) && !empty($price_to)){
                        $products->where('product_price','<=',$price_to);
                    }

                    //brand wise filtering
                    if(isset($brand) && !empty($brand)){
                        $products->whereIn('brand_id',$brand);
                    }
                }


                //sorting
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
                if($request->ajax()){
                     $products = $products->paginate(20);
                    return view('frontend.products.ajax_listing',compact('products'));
                }else{
                    $products = $products->paginate(20);
                    return view('frontend.products.listing', compact('products', 'breadCrumb','parentCategory','url','category'));
                }

            } else {
                abort(404);
            }

      }

      public function shop(Request $request){
            $products = Product::with('category','category.subcategories','brand')->where('status', 1);

            if($request->input('search')){
                $search = $request->input('search');
                $products = $products->where('product_name','like','%'.$search.'%')
                            ->orWhere('product_color','like','%'.$search.'%')
                            ->orWhere('product_code','like','%'.$search.'%')
                            ->orWhereHas('category',function ($q) use ($search) {
                               $q->where('category_name','like','%'.$search.'%');
                            }) ->orWhereHas('brand',function ($q) use ($search) {
                               $q->where('name','like','%'.$search.'%');
                            });
            }
          if($request->ajax()) {
              $url = $request->input('url');
              $sort = $request->input('sort');
              $size = $request->input('size');
              $product_color = $request->input('product_color');
              $price_from = $request->input('price_from');
              $price_to = $request->input('price_to');
              $brand = $request->input('brand');
              //check dynamic filter
              $productFilters = ProductFilter::getFilter();
              foreach ($productFilters as $key => $filter) {
                  if (isset($filter->filter_column) && isset($request[$filter->filter_column]) &&
                      !empty($filter->filter_column) && !empty($request[$filter->filter_column])) {
                      $products->whereIn($filter->filter_column, $request[$filter->filter_column]);
                  }
              }

              //size wise filtering
              if (isset($size) && !empty($size)) {
                  $products->whereHas('attributes', function ($query) use ($size) {
                      $query->whereIn('size', $size);
                  });
              }
              //color wise filtering
              if (isset($product_color) && !empty($product_color)) {
                  $products->whereIn('product_color', $product_color);
              }
              //price wise filtering
              if (isset($price_from) && !empty($price_from)) {
                  $products->where('product_price', '>=', $price_from);
              }
              if (isset($price_to) && !empty($price_to)) {
                  $products->where('product_price', '<=', $price_to);
              }

              //brand wise filtering
              if (isset($brand) && !empty($brand)) {
                  $products->whereIn('brand_id', $brand);
              }
          }


              //sorting
              if (isset($sort) && !empty($sort)) {
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
              }  else{
              $products = $products->orderBy('id', 'desc');
          }
          $products = $products->paginate(20);

          if($request->ajax()){
              return view('frontend.products.ajax_listing', compact('products'));
          }else{
              return view('frontend.products.shop', compact('products'));
          }

      }

      public function vendorListing($vendorId){
           $vendor = Vendor::getVendorShop($vendorId);

           $products = Product::with('brand')
               ->where('vendor_id',$vendorId)
               ->where('status',1)
               ->orderBy('id','desc')
               ->paginate(20);

           return view('frontend.products.vendor_listing',compact('products','vendor'));
      }


      public function productDetails($slug)
      {
             $product = Product::with(['section','category', 'brand', 'vendor','images','vendor', 'attributes' => function($query){
                $query->where('stock','>',0);
             }])->whereSlug($slug)->whereStatus(1)->first();

              abort_if(!$product,404);


          if ($product->category->url) {

              if ($product->category->parent_id == null) {
                  $breadCrumb = $product->category;
                  $parentCategory = [];
              } else {
                  $parentCategory = Category::where('id', $product->category->parent_id)->first();
                  $breadCrumb = $product->category;
              }

                $relatedProducts = Product::with('category','category.subcategories','brand')
                    ->where('category_id', $product->category_id)
                    ->where('status', 1)
                    ->where('id','!=',$product->id)
                    ->inRandomOrder()->orderBy('id','desc')
                    ->limit(10)->get();

              //set session recently product
              if(empty(Session::get('session_id'))){
                  $session_id = Hash::make(time());
                  Session::put('session_id',$session_id);
              }else{
                    $session_id = Session::get('session_id');
              }
              $countRecentViewProducts = DB::table('recently_viewed_products')->where('product_id',$product->id)->where('session_id',$session_id)->count();

              if($countRecentViewProducts == 0){
                  DB::table('recently_viewed_products')->insert([
                      'session_id' => $session_id,
                      'product_id' => $product->id,
                      'created_at' => now(),
                      'updated_at' => now()
                  ]);
              }
               $recentViewProductIds = DB::table('recently_viewed_products')
                  ->where('session_id',$session_id)
                  ->where('product_id','!=',$product->id)
                  ->inRandomOrder()->limit(10)->pluck('product_id');

              $recent_viewed_products = Product::with('category','category.subcategories','brand')
                  ->whereIn('id', $recentViewProductIds)
                  ->where('status', 1)->get();



              if(auth()->check()){
                     $order = Order::where('user_id',auth()->id())->pluck('id');
                      $orderCount = OrderProduct::whereIn('order_id',$order)->where('product_id',$product->id)->count();
              }else{
                  $orderCount = 0;
              }


              return view('frontend.products.product_details', compact('product','breadCrumb','parentCategory','relatedProducts','recent_viewed_products','orderCount'));

          }
      }

      public function getProductPrice(Request $request){
          if($request->ajax()){
                 $getDiscountAttributePrice = Product::getDiscountAttributePrice($request->product_id,$request->size);
                 return response()->json($getDiscountAttributePrice);
          }
      }


}
