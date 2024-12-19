<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // ถ้ามี query string 'users_page' ให้โหลด Users
        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->paginate(6, ['*'], 'users_page');
        $roles = Role::all();

        // // ถ้ามี query string 'user_roles_page' ให้โหลด User Roles
        // $userRoles = RoleUser::query()
        //     ->paginate(6, ['*'], 'user_roles_page');

        return view('dashboard.user-management', compact('users', 'roles'));
    }

 



    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:Admin,User',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('dashboard.user-management')->with('status', 'User role updated successfully!');
    }
}
