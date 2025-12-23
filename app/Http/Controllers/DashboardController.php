<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Notification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        return $this->userDashboard();
    }

    private function adminDashboard()
    {
        $stats = [
            'total_tasks' => Task::count(),
            'tasks_todo' => Task::where('status', 'à faire')->count(),
            'tasks_in_progress' => Task::where('status', 'en cours')->count(),
            'tasks_completed' => Task::where('status', 'terminé')->count(),
            'total_users' => \App\Models\User::count(),
            'active_users' => \App\Models\User::where('is_active', true)->count(),
            'overdue_tasks' => Task::where('date_fin', '<', now())
                ->where('status', '!=', 'terminé')
                ->count(),
        ];

        $recent_tasks = Task::with(['assignedUser', 'category'])
            ->latest()
            ->limit(10)
            ->get();

        $recent_users = \App\Models\User::latest()->limit(5)->get();

        return view('dashboard.admin', compact('stats', 'recent_tasks', 'recent_users'));
    }

    private function userDashboard()
    {
        $user = Auth::user();

        $stats = [
            'my_tasks' => Task::where('assigned_to', $user->id)->count(),
            'tasks_todo' => Task::where('assigned_to', $user->id)
                ->where('status', 'à faire')
                ->count(),
            'tasks_in_progress' => Task::where('assigned_to', $user->id)
                ->where('status', 'en cours')
                ->count(),
            'tasks_completed' => Task::where('assigned_to', $user->id)
                ->where('status', 'terminé')
                ->count(),
            'overdue_tasks' => Task::where('assigned_to', $user->id)
                ->where('date_fin', '<', now())
                ->where('status', '!=', 'terminé')
                ->count(),
        ];

        $my_tasks = Task::where('assigned_to', $user->id)
            ->with(['category', 'creator'])
            ->latest()
            ->limit(10)
            ->get();

        $unread_messages = Message::where('destinataire_id', $user->id)
            ->where('lu', false)
            ->count();

        $unread_notifications = Notification::where('user_id', $user->id)
            ->where('vue', false)
            ->count();

        return view('dashboard.user', compact('stats', 'my_tasks', 'unread_messages', 'unread_notifications'));
    }
}

