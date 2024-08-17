<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index() {
        $users = User::get();
        return view('roles-permission.users.index', ['users' => $users]);
    }

    public function create() {
        $roles = Role::pluck('name', 'name')->all();
        return view('roles-permission.users.create', ['roles' => $roles]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            $user->syncRoles($request->input('roles'));
            return redirect('users')->with('status', 'User created successfully.');
        }
    }

    public function edit($id) {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('roles-permission.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, $id) {
        $id = $request->input('id');
        $user = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'roles' => 'required'
        ]);

        if (!empty($request->password)) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $update = $user->update($validatedData);
        if ($update) {
            $user->syncRoles($request->input('roles'));
            return redirect('users')->with('status', 'User updated successfully.');
        }
    }

    public function destroy($id) {
        $user = User::find($id);
        if ($user->delete()) {
            return redirect('users')->with('status', 'User deleted successfully.');
        }
    }
}
