<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
   public function index() {
      $permissions = Permission::get();
      return view('roles-permission.permissions.index',['permissions' => $permissions]);
   }

   public function create() {
      return view('roles-permission.permissions.create');
   }

   public function store(Request $request) {
      $validated_data = $request->validate([
          'name' => 'required|string|unique:permissions,name',
      ]);

      $create = Permission::create(['name' => $validated_data['name']]);
      if($create) {
          return redirect('permissions')->with('status', 'Permission created successfully');
      }
   }

   public function edit($id) {
     $permission = Permission::find($id);
       return view('roles-permission.permissions.edit', ['permission' => $permission]);
   }

   public function update(Request $request) {
       $id = $request->input('id');
       if (!empty($id)) {
           $permission = Permission::find($id);
           $validated_data = $request->validate([
               'name' => 'required|string|unique:permissions,name',
           ]);
           $update = $permission->update($validated_data);
           if ($update) {
               return redirect('permissions')->with('status', 'Permission updated successfully');
           }
       }
   }

   public function destroy($id) {
     $permission = Permission::find($id);
     if ($permission) {
         $delete = $permission->delete();
         if ($delete) {
             return redirect('permissions')->with('status', 'Permission deleted successfully');
         }
     }
   }
}
