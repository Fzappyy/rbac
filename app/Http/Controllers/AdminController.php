<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageUsers(Request $request)
    {
        $users = User::all();
        $roles = Role::all();

        if ($request->isMethod('post')) {
            $roleIds = $request->input('role_id');

            foreach ($roleIds as $userId => $roleId) {
                $user = User::find($userId);
                if ($user) {
                    $user->roles()->detach();
                    if ($roleId) {
                        $user->roles()->attach($roleId);
                    }
                }
            }

            return redirect()->back()->with('success', 'Role assigned successfully.');
        }

        return view('admin.manageUsers')->with(compact('users', 'roles'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }
}
