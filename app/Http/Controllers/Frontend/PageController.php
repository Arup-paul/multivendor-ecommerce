<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;

class PageController extends Controller
{
     public function page($slug){
         $page = CmsPage::where('url',$slug)->first();
         return view('frontend.page',compact('page'));
     }
}
