<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::get();
        return view('roles-permission.roles.index',['roles' => $roles]);
    }

    public function create() {
        return view('roles-permission.roles.create');
    }

    public function store(Request $request) {
        $validated_data = $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        $create = Role::create(['name' => $validated_data['name']]);
        if($create) {
            return redirect('roles')->with('status', 'Role created successfully');
        }
    }

    public function edit($id) {
        $role = Role::find($id);
        return view('roles-permission.roles.edit', ['role' => $role]);
    }

    public function update(Request $request) {
        $id = $request->input('id');
        if (!empty($id)) {
            $role = Role::find($id);
            $validated_data = $request->validate([
                'name' => 'required|string|unique:permissions,name',
            ]);
            $update = $role->update($validated_data);
            if ($update) {
                return redirect('roles')->with('status', 'Role updated successfully');
            }
        }
    }

    public function destroy($id) {
        $role = Role::find($id);
        if ($role) {
            $delete = $role->delete();
            if ($delete) {
                return redirect('roles')->with('status', 'Role deleted successfully');
            }
        }
    }

    public function givePermissionsToRole($role_id) {
        $role = Role::findOrFail($role_id);
        $permissions = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_id', $role_id)->pluck('permission_id')->toArray();
        return view('roles-permission.roles.add-permission',
            ['role' => $role, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]
        );
    }

    public static function updatePermissionsToRole(Request $request, $role_id) {
       $role = Role::findOrFail($role_id);
       $validated_data = $request->validate([
           'permissions' => 'required'
       ]);
      $assign_permissions =  $role->syncPermissions($validated_data['permissions']);
      if ($assign_permissions) {
          return redirect()->back()->with('status', 'Permissions added to role successfully');
      }
    }
}
