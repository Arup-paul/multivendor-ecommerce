<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFilterValue;
use Illuminate\Http\Request;

class FilterValueController extends Controller
{
    public function index()
    {
       $filters = ProductFilterValue::with('filterValues')->paginate(20);

        return view('admin.product-filter-values.index',compact('filters'));
    }
}
