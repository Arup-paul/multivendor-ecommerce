<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      $sliders = Option::whereType('slider')->whereStatus(1)->get();
      $newProducts = Product::with('category','brand')->orderBy('id', 'desc')->whereStatus(1)->take(10)->get();
      $bestSellerProducts = Product::with('category','brand')->whereFeatured('is_best_seller')->whereStatus(1)->inRandomOrder()->take(10)->get();
      $featuredProducts = Product::with('category','brand')->whereFeatured('is_featured')->whereStatus(1)->inRandomOrder()->take(10)->get();
      $discountProducts = Product::with('category','brand')->where('product_discount' ,'>',0)->whereStatus(1)->inRandomOrder()->take(10)->get();
      $bestRatedProducts = Product::with('category','brand')->whereFeatured('is_best_rated')->whereStatus(1)->inRandomOrder()->take(10)->get();
      return view('frontend.index',compact('sliders','newProducts','bestSellerProducts','featuredProducts','discountProducts','bestRatedProducts'));
    }
}
