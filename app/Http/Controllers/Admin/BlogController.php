<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('admin.blog.index',compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request){
        $request->validate([
           'title' => 'required',
           'description' => 'required',
           'image' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->image = $request->image;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->status = $request->status;
        $blog->save();

        return response()->json( [ 'message' =>  'Blog created successfully'] );

    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit',compact('blog'));
    }

    public function update(Request $request,$id){
        $request->validate([
           'title' => 'required',
           'description' => 'required',
           'image' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->image = $request->image;
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->status = $request->status;
        $blog->save();

        return response()->json( [ 'message' =>  'Blog updated successfully'] );

    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $blog = Blog::findOrFail($id);
                    $blog->delete();
                }
                return response()->json([
                    'message' =>  __('Blogs Deleted Successfully'),
                    'redirect' => route('admin.blogs.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }

    }
}
