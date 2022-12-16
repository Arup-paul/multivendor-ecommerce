<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function create(){
       return view('admin.admins.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'mobile' => 'required|unique:admins',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->mobile = $request->input('mobile');
        $admin->image = $request->input('image');
        $admin->type = $request->input('role');
        $admin->password =  Hash::make($request->input('password'));
        $admin->save();

        return response()->json( [ 'message' =>  'Admin/Subadmin Created successfully'] );

    }

    public function edit(Request $request,$id){
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit',compact('admin'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric|unique:admins,mobile,' . $id,
            'email' => 'required|email|unique:admins,email,' . $id,
            'role' => 'required'
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->mobile = $request->input('mobile');
        $admin->image = $request->input('image');
        $admin->type = $request->input('role');
        if(!is_null($request->input('password'))){
            $admin->password =  Hash::make($request->input('password'));
        }
        $admin->save();

        return response()->json( [ 'message' =>  'Admin/Subadmin Updated successfully'] );

    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $brand = Admin::findOrFail($id);
                    $brand->delete();
                }
                return response()->json([
                    'message' =>  __('Admin Deleted Successfully'),
                    'redirect' => route('admin.brands.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }




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
