<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::paginate(20);
        return view('admin.sections.index',compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $section = new Section();
        $section->name = $request->name;
        $section->status = $request->status;
        $section->save();

        return response()->json( [ 'message' =>  'Section created successfully'] );
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('admin.sections.edit',compact('section'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $section = Section::findOrFail($id);
        $section->name = $request->name;
        $section->status = $request->status;
        $section->save();

        return response()->json( [ 'message' =>  'Section updated successfully'] );
    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
         if (isset($request->ids)) {
          foreach ($request->ids as $id) {
            $section = Section::findOrFail($id);
            $section->delete();
           }
            return response()->json([
                'message' =>  __('Section Deleted Successfully'),
                'redirect' => route('admin.sections.index')
            ]);
        }else{
            return  response()->json(   __('Please Select Checkbox'),422 );
        }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }




    }
}
