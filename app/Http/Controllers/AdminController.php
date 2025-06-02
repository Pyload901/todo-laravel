<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_todos' => Todo::count(),
            'admin_users' => User::role('admin')->count(),
            'regular_users' => User::role('user')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display all users
     */
    public function users()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Display all todos from all users
     */
    public function allTodos()
    {
        $todos = Todo::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.todos', compact('todos'));
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user'
        ]);

        // Remove all current roles and assign the new one
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    /**
     * Delete a user
     */
    public function deleteUser(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    /**
     * Delete any todo (admin privilege)
     */
    public function deleteTodo(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('success', 'Todo deleted successfully.');
    }
}
