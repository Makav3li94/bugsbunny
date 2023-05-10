<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;

class RoleController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:role')->except('dashboard');
//        $this->middleware('permission:admin')->except('dashboard');
    }

    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.roles.index', compact('roles','permissions'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permission'));


        return redirect()->route('admin.roles.index')
            ->with('success', 'غل با موفقیت ایجاد شد.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request , Role $role){
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('admin.roles.index')
            ->with('success','نقش ویرایش شد.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with(['delete' => 'success']);
    }
}

