<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Option;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){

      $sliders = Option::whereType('slider')->whereStatus(1)->get();
      $newProducts = Product::with('category','brand','attributes')->orderBy('id', 'desc')->whereStatus(1)->take(10)->get();
      $bestSellerProducts = Product::with('category','brand')->whereFeatured('is_best_seller')->whereStatus(1)->inRandomOrder()->take(10)->get();
      $featuredProducts = Product::with('category','brand')->whereFeatured('is_featured')->whereStatus(1)->inRandomOrder()->take(10)->get();
      $discountProducts = Product::with('category','brand')->where('product_discount' ,'>',0)->whereStatus(1)->inRandomOrder()->take(10)->get();
      $bestRatedProducts = Product::with('category','brand')->whereFeatured('is_best_rated')->whereStatus(1)->inRandomOrder()->take(10)->get();


       $categories = Category::withCount('products')->where('parent_id', null)->whereStatus(1)->get();
       $brands = Brand::whereStatus(1)->get();
        //set session recently product
        if(empty(Session::get('session_id'))){
            $session_id = Hash::make(time());
            Session::put('session_id',$session_id);
        }else{
            $session_id = Session::get('session_id');
        }
        $blogs = Blog::whereStatus(1)->orderBy('id','desc')->take(3)->get();
      return view('frontend.index',compact('sliders','newProducts','bestSellerProducts','featuredProducts','discountProducts','bestRatedProducts','categories','brands','blogs'));
    }
}
