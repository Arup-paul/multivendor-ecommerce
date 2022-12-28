<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
     public function blogs(){
         $blogs = Blog::whereStatus(1)->paginate(12);
          return view('frontend.blogs.blogs',compact('blogs'));
     }
}
