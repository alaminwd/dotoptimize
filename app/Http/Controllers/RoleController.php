<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
  

     //Role Manager
     function role(){
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.role.role', [
            'permissions'=>$permissions,
            'roles'=>$roles,
            'users'=>$users,
        ]);
    }

    // Persmission
    function permission_store(Request $request){
         Permission::create(['name' => $request->permission]);
         return back();
    }

    // Role store 
    function role_store(Request $request){
        $role = Role::create(['name' => $request->role_name]);

        $role->givePermissionTo($request->permission);
        return back()->with('role_succ', 'Successfully Added');
        
    }

    // Assign Role
    function assign_role(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back();
    }

    // Remove Role
    function remove_role($user_id){
        $user = User::find($user_id);
        $user->syncPermissions([]);
        $user->syncRoles([]);
        return back();
    }

    // Role remove
    function role_delete($role_id){
        $role = Role::find($role_id);
        $role->syncPermissions([]);
        $role->delete();
        return back();
    }

}
