<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    public function admins(Request $request){
          $admins = Admin::query()
            ->where('type', '!=', 'vendor')
            ->when($request->get('type') != 'vendor' && $request->get('type') != null, function (Builder $query) use ($request) {
                $query->where('type', '=', $request->get('type'));
            })
            ->latest()
            ->paginate(10);


        $all = Admin::where('type', '!=', 'vendor')->get();
        $adminCount = Admin::where('type','admin')->get();
        $superAdminCount = Admin::where('type','superadmin')->get();

        return view('admin.admins.admin',compact('admins','all','adminCount','superAdminCount'));
    }


    public function vendorDetails($id)
    {
        $admin = Admin::with('vendor','vendorBusiness','vendorBank')->findOrFail($id);

        return view('admin.admins.vendorDetails',compact('admin'));
    }

    public function updateStatus($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->status == 1) {
            $admin->status = 0;
        }else{
            $admin->status = 1;
        }
        $admin->save();

        return  response()->json([
            'message' => __('Status Updated Successfully'),
            'redirect' => url()->previous()
        ]);

    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string'],
            'message' => ['required', 'string']
        ]);

        return "test";

    }

}
