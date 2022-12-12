<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = CmsPage::paginate(10);
        return view('admin.page.index',compact('pages'));
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'position' => 'required',
        ]);

        $page = new CmsPage();
        $page->title = $request->title;
        $page->url = Str::slug($request->title);
        $page->description = $request->description;
        $page->meta_title = $request->meta_title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->meta_title = $request->meta_title;
        $page->position = $request->position;
        $page->status = $request->status;
        $page->save();

        return response()->json( [ 'message' =>  'Page created successfully'] );

    }

    public function edit($id){
        $page = CmsPage::findOrFail($id);
        return view('admin.page.edit',compact('page'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'position' => 'required',
        ]);

        $page = CmsPage::findOrFail($id);
        $page->title = $request->title;
        $page->description = $request->description;
        $page->meta_title = $request->meta_title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->meta_title = $request->meta_title;
        $page->position = $request->position;
        $page->status = $request->status;
        $page->save();

        return response()->json( [ 'message' =>  'Page updated successfully'] );

    }

    public function massDestroy(Request $request)
    {
        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $page = CmsPage::findOrFail($id);

                    $page->delete();
                }
                return response()->json([
                    'message' =>  __('Page Deleted Successfully'),
                    'redirect' => route('admin.categories.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }




    }
}
