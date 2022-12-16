<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function rolePermission($id){
        $admin = Admin::findOrFail($id);
        $rolePermission = Role::where('admin_id',$id)->get();
       return view('admin.admins.role_permission',compact('admin','rolePermission'));
    }
    public function rolePermissionUpdate(Request $request,$id){
           $data = $request->except('_token');

           foreach ($data as $key => $value){
               $view = isset($value['view']) ? 1 : 0;
               $edit = isset($value['edit']) ? 1 : 0;
               $create = isset($value['create']) ? 1 : 0;
               $all = isset($value['all']) ? 1 : 0;

               Role::updateOrCreate([
                  'admin_id' => $id,
                  'module' => $key,
               ],[
                  'view' => $view,
                  'edit'  => $edit,
                  'create'  => $create,
                  'all'  => $all,
               ]);
           }

        return response()->json( [ 'message' =>  'Role/Permission updated successfully'] );

    }
}
