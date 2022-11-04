<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      $sliders = Option::whereType('slider')->whereStatus(1)->get();
      $newProducts = Product::with('category')->orderBy('id', 'desc')->whereStatus(1)->take(10)->get();
      $bestSellerProducts = Product::with('category')->whereFeatured('is_best_seller')->whereStatus(1)->inRandomOrder()->take(10)->get();
      $featuredProducts = Product::with('category')->whereFeatured('is_featured')->whereStatus(1)->inRandomOrder()->take(10)->get();
      $discountProducts = Product::with('category')->where('product_discount' ,'>',0)->whereStatus(1)->inRandomOrder()->take(10)->get();
      $bestRatedProducts = Product::with('category')->whereFeatured('is_best_rated')->whereStatus(1)->inRandomOrder()->take(10)->get();
      return view('frontend.index',compact('sliders','newProducts','bestSellerProducts','featuredProducts','discountProducts','bestRatedProducts'));
    }
}
