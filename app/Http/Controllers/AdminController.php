<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Category;
use App\Models\Statistique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::with('profile')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        \App\Models\UserProfile::create(['user_id' => $user->id]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé!');
    }

    public function editUser(User $user)
    {
        $user->load('profile');
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour!');
    }

    public function categories()
    {
        $categories = Category::with('creator')->latest()->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'icon' => 'nullable|string|max:50',
        ]);

        $validated['created_by'] = Auth::id();
        Category::create($validated);

        return redirect()->route('admin.categories')->with('success', 'Catégorie créée!');
    }

    public function statistics()
    {
        $stats = [
            'total_tasks' => Task::count(),
            'tasks_todo' => Task::where('status', 'à faire')->count(),
            'tasks_in_progress' => Task::where('status', 'en cours')->count(),
            'tasks_completed' => Task::where('status', 'terminé')->count(),
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'overdue_tasks' => Task::where('date_fin', '<', now())
                ->where('status', '!=', 'terminé')
                ->count(),
        ];

        $tasks_by_status = Task::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $tasks_by_priority = Task::selectRaw('priority, COUNT(*) as count')
            ->groupBy('priority')
            ->pluck('count', 'priority');

        $recent_tasks = Task::with(['assignedUser', 'category'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.statistics', compact('stats', 'tasks_by_status', 'tasks_by_priority', 'recent_tasks'));
    }
}

