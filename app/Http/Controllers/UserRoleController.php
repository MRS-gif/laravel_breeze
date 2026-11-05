<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    // Seluruh route controller ini dibungkus middleware permission:kelola role.

    public function index(): View
    {
        $users = User::with('roles')->orderBy('name')->paginate(15);
        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', Rule::exists('roles', 'name')],
        ]);

        // Cegah Admin menurunkan role dirinya sendiri (agar tidak terkunci).
        if ($user->id === $request->user()->id && $data['role'] !== 'Admin') {
            return back()->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri.');
        }

        $user->syncRoles($data['role']);

        return back()->with('success', "Role {$user->name} diubah menjadi {$data['role']}.");
    }
}
