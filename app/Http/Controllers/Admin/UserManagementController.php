<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserManagementController extends Controller
{
    // Вывод списка пользователей
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::pluck('name'); // Список ролей

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    // Обновление роли пользователя
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users')
        ->with('success', 'Роль пользователя успешно обновлена.');
    }
}

