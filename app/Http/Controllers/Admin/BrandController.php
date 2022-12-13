<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(20);
        return view('admin.brands.index',compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        $section = new Brand();
        $section->name = $request->name;
        $section->image = $request->image;
        $section->status = $request->status;
        $section->save();

        return response()->json( [ 'message' =>  'Brand created successfully'] );
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit',compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $section = Brand::findOrFail($id);
        $section->name = $request->name;
        $section->image = $request->image;
        $section->status = $request->status;
        $section->save();

        return response()->json( [ 'message' =>  'Brand updated successfully'] );
    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $brand = Brand::findOrFail($id);
                    $brand->delete();
                }
                return response()->json([
                    'message' =>  __('Brand Deleted Successfully'),
                    'redirect' => route('admin.brands.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }




    }
}
