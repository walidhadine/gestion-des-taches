<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function unread()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->where('vue', false)
            ->latest()
            ->limit(10)
            ->get();

        return response()->json($notifications);
    }

    public function count()
    {
        $count = Notification::where('user_id', Auth::id())
            ->where('vue', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('vue', false)
            ->update(['vue' => true]);

        return response()->json(['success' => true]);
    }

    public function destroy(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification supprimée');
    }
}

