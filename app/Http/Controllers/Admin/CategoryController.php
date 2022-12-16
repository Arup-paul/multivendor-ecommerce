<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Role;
use App\Models\Section;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $permissionExist = Role::where('admin_id',auth()->guard('admin')->id())->where('module','categories')->first();

        if(auth('admin')->user()->type == 'superadmin'){
            $permission = [];
        }else{
            if($permissionExist){
                if(!$permissionExist->view && !$permissionExist->create && !$permissionExist->edit && !$permissionExist->all){
                    abort(404);
                }else{
                    $permission = $permissionExist;
                }
            }else{
                $permission = [];
            }
        }



        $categories = Category::with('parentCategory','section')->paginate(20);

        return view('admin.categories.index',compact('categories','permission'));
    }

    public function create()
    {
        if(!auth('admin')->user()->type == 'superadmin'){
            $permissionExist = Role::where('admin_id',auth()->guard('admin')->id())->where('module','categories')->first();
            if(!$permissionExist->create &&   !$permissionExist->all){
                abort(404);
            }
        }
        $getCategories = [];
        $sections = Section::where('status',1)->get();
        return view('admin.categories.create',compact('getCategories','sections'));
    }

    public function store(Request $request){
       $request->validate([
           'category_name' => 'required',
           'category_discount' => 'numeric',
           'section_id' => 'required',
           'category_image' => 'required',
           'url' => 'required|unique:categories',
       ],[
           'section_id.required' => 'Section is required',
       ]);

       $category = new Category();
       $category->category_name = $request->category_name;
       $category->parent_id = $request->parent_id ?? null;
       $category->section_id = $request->section_id;
       $category->url = $request->url;
       $category->category_discount = $request->category_discount;
       $category->category_image = $request->category_image;
       $category->description = $request->description;
       $category->meta_title = $request->meta_title;
       $category->meta_description = $request->meta_description;
       $category->meta_keywords = $request->meta_keywords;
       $category->status = $request->status;
       $category->save();

        return response()->json( [ 'message' =>  'Category created successfully'] );

    }

    public function edit($id){
        if(!auth('admin')->user()->type == 'superadmin') {
            $permissionExist = Role::where('admin_id', auth()->guard('admin')->id())->where('module', 'categories')->first();
            if (!$permissionExist->edit && !$permissionExist->all) {
                abort(404);
            }
        }

        $sections = Section::where('status',1)->get();
        $category = Category::findOrFail($id);
         $getCategories = Category::where(['parent_id' => null])->get();

        return view('admin.categories.edit',compact('getCategories','sections','category'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'category_name' => 'required',
            'category_discount' => 'numeric',
            'section_id' => 'required',
            'category_image' => 'required',
            'url' => 'required|unique:categories,url,'.$id,
        ],[
            'section_id.required' => 'Section is required',
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->parent_id = $request->parent_id ?? null;
        $category->section_id = $request->section_id;
        $category->url = $request->url;
        $category->category_discount = $request->category_discount;
        $category->category_image = $request->category_image;
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->status = $request->status;
        $category->save();

        return response()->json( [ 'message' =>  'Category updated successfully'] );

    }


    public function massDestroy(Request $request)
    {
        $permissionExist = Role::where('admin_id',auth()->guard('admin')->id())->where('module','categories')->first();
        if(!$permissionExist->edit &&   !$permissionExist->all){
            return  response()->json(   __('Permission Restricted'),422 );
        }
        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $category = Category::findOrFail($id);
                    if(file_exists($category->category_image)){
                        unlink($category->category_image);
                    }
                    $category->delete();
                }
                return response()->json([
                    'message' =>  __('Category Deleted Successfully'),
                    'redirect' => route('admin.categories.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }

    }

    public function appendCategoriesLevel(Request $request){
       if($request->ajax()){
           $getCategories = Category::with('subcategories')
               ->where('section_id',$request->section_id)
               ->where('parent_id',null)
               ->where('status',1)
               ->get();
           return view('admin.categories.append-categories-level',compact('getCategories'));
       }

    }



}
