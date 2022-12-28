<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BlogController extends Controller
{
     public function blogs(Request $request){
         $blogs = Blog::when($request->get('search'), function (Builder $query) use($request){
             $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
         })->whereStatus(1)->paginate(12);
          return view('frontend.blogs.blogs',compact('blogs'));
     }

     public function blogDetails($slug){
         $blog = Blog::whereSlug($slug)->first();
         $recentBlog = Blog::whereStatus(1)->where('slug','!=',$slug)->orderBy('id','desc')->limit(5)->get();
         return view('frontend.blogs.blog-details',compact('blog','recentBlog'));
     }
}
