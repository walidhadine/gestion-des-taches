<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $type = $request->get('type', 'received');

        if ($type === 'sent') {
            $messages = Message::where('expediteur_id', $user->id)
                ->where('is_archived_exp', false)
                ->with(['destinataire', 'task'])
                ->latest()
                ->paginate(20);
        } else {
            $messages = Message::where('destinataire_id', $user->id)
                ->where('is_archived_dest', false)
                ->with(['expediteur', 'task'])
                ->latest()
                ->paginate(20);
        }

        $unread_count = Message::where('destinataire_id', $user->id)
            ->where('lu', false)
            ->count();

        return view('messages.index', compact('messages', 'type', 'unread_count'));
    }

    public function create(Request $request)
    {
        $users = User::where('id', '!=', Auth::id())
            ->where('is_active', true)
            ->get();
        
        $tasks = Task::where('assigned_to', Auth::id())
            ->orWhere('created_by', Auth::id())
            ->get();

        $selected_user = $request->get('user_id') ? User::find($request->get('user_id')) : null;
        $selected_task = $request->get('task_id') ? Task::find($request->get('task_id')) : null;

        return view('messages.create', compact('users', 'tasks', 'selected_user', 'selected_task'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinataire_id' => 'required|exists:users,id',
            'task_id' => 'nullable|exists:tasks,id',
            'sujet' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['expediteur_id'] = Auth::id();

        $message = Message::create($validated);

        // Notification
        \App\Models\Notification::create([
            'user_id' => $validated['destinataire_id'],
            'type' => 'message',
            'titre' => 'Nouveau message',
            'contenu' => Auth::user()->full_name . ' vous a envoyé un message',
            'lien' => route('messages.show', $message->id),
            'data' => ['message_id' => $message->id],
        ]);

        return redirect()->route('messages.index')->with('success', 'Message envoyé!');
    }

    public function show(Message $message)
    {
        $user = Auth::user();
        
        if ($message->expediteur_id !== $user->id && $message->destinataire_id !== $user->id) {
            abort(403);
        }

        if ($message->destinataire_id === $user->id && !$message->lu) {
            $message->update(['lu' => true]);
        }

        $message->load(['expediteur', 'destinataire', 'task']);

        return view('messages.show', compact('message'));
    }

    public function markAsRead(Message $message)
    {
        if ($message->destinataire_id === Auth::id()) {
            $message->update(['lu' => true]);
        }

        return response()->json(['success' => true]);
    }

    public function archive(Message $message)
    {
        $user = Auth::user();

        if ($message->expediteur_id === $user->id) {
            $message->update(['is_archived_exp' => true]);
        } elseif ($message->destinataire_id === $user->id) {
            $message->update(['is_archived_dest' => true]);
        }

        return redirect()->route('messages.index')->with('success', 'Message archivé');
    }

    public function destroy(Message $message)
    {
        $user = Auth::user();

        if ($message->expediteur_id === $user->id) {
            $message->update(['is_archived_exp' => true]);
        } elseif ($message->destinataire_id === $user->id) {
            $message->update(['is_archived_dest' => true]);
        } else {
            abort(403);
        }

        return redirect()->route('messages.index')->with('success', 'Message supprimé');
    }
}

