<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductFilter;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FilterController extends Controller
{
    public function index()
    {
        $filters = ProductFilter::with('category')->paginate(20);
        return view('admin.product-filter.index',compact('filters'));
    }

    public function create()
    {
        $categories = Category::select(['id','category_name'])->where('status',1)->get();
        return view('admin.product-filter.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'filter_name' => 'required',
            'filter_column' => 'required|unique:product_filters',
            'category_id' => 'required',
        ]);


        $filter = new ProductFilter();
        $filter->filter_name = $request->filter_name;
        $filter->filter_column = $request->filter_column;
        $filter->category_id = implode(',',$request->category_id);
        $filter->status = $request->status;
        $filter->save();

        //add filter column for product table
       DB::statement('ALTER TABLE products ADD '.$request->filter_column.' VARCHAR(255) NULL AFTER description');

        return response()->json( [ 'message' =>  'Product Filter created successfully'] );
    }

    public function edit($id)
    {
        $filter = ProductFilter::findOrFail($id);

        $categories = Category::select(['id','category_name'])->where('status',1)->get();
        return view('admin.product-filter.edit',compact('filter','categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'filter_name' => 'required',
            'category_id' => 'required',
        ]);

        $filter = ProductFilter::findOrFail($id);
        $filter->filter_name = $request->filter_name;
        $filter->category_id = implode(',',$request->category_id);
        $filter->status = $request->status;
        $filter->save();

        return response()->json( [ 'message' =>  'Product Filter Updated successfully'] );
    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $filter = ProductFilter::findOrFail($id);
                    if (Schema::hasColumn('products', $filter->filter_column)) {
                        DB::statement('ALTER TABLE products DROP COLUMN   '.$filter->filter_column.'');
                    }
                    $filter->delete();
                }
                return response()->json([
                    'message' =>  __('Filter Deleted Successfully'),
                    'redirect' => route('admin.filters.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }




    }
}
