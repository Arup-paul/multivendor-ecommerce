<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFilter;
use App\Models\ProductFilterValue;
use Illuminate\Http\Request;

class FilterValueController extends Controller
{
    public function index()
    {
       $filters = ProductFilterValue::with('productFilter')->paginate(20);

        return view('admin.product-filter-values.index',compact('filters'));
    }
    public function create()
    {
        $filterData = ProductFilter::select(['id','filter_name'])->where('status',1)->get();
        return view('admin.product-filter-values.create',compact('filterData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_filter_id' => 'required',
            'filter_value' => 'required|unique:product_filter_values',
        ]);

        $filter = new ProductFilterValue();
        $filter->product_filter_id = $request->product_filter_id;
        $filter->filter_value = $request->filter_value;
        $filter->status = $request->status;
        $filter->save();

        return response()->json( [ 'message' =>  'Product Filter Value created successfully'] );
    }

    public function edit($id)
    {
        $filterValue = ProductFilterValue::findOrFail($id);
        $filterData = ProductFilter::select(['id','filter_name'])->where('status',1)->get();
        return view('admin.product-filter-values.edit',compact('filterValue','filterData'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_filter_id' => 'required',
            'filter_value' => 'required|unique:product_filter_values,filter_value,'.$id,
        ]);

        $filter = ProductFilterValue::findOrFail($id);
        $filter->product_filter_id = $request->product_filter_id;
        $filter->filter_value = $request->filter_value;
        $filter->status = $request->status;
        $filter->save();

        return response()->json( [ 'message' =>  'Product Filter Value update successfully'] );
    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $filter = ProductFilterValue::findOrFail($id);
                    $filter->delete();
                }
                return response()->json([
                    'message' =>  __('Filter Value Deleted Successfully'),
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
