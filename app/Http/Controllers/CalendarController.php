<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function getEvents(Request $request)
    {
        $user = Auth::user();
        $start = $request->get('start');
        $end = $request->get('end');

        $events = Event::where('user_id', $user->id)
            ->whereBetween('start_date', [$start, $end])
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->titre,
                    'start' => $event->start_date->toIso8601String(),
                    'end' => $event->end_date->toIso8601String(),
                    'color' => $event->couleur,
                    'description' => $event->description,
                    'type' => $event->type,
                ];
            });

        // Ajouter les tâches comme événements
        $tasks = Task::where('assigned_to', $user->id)
            ->whereNotNull('date_fin')
            ->get()
            ->map(function ($task) {
                return [
                    'id' => 'task_' . $task->id,
                    'title' => $task->titre,
                    'start' => $task->date_fin->toIso8601String(),
                    'end' => $task->date_fin->toIso8601String(),
                    'color' => $task->category->color ?? '#3498db',
                    'description' => $task->description,
                    'type' => 'tache',
                ];
            });

        return response()->json($events->merge($tasks));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:tache,reunion,personnel,projet',
            'couleur' => 'nullable|string|max:7',
            'task_id' => 'nullable|exists:tasks,id',
            'lieu' => 'nullable|string|max:255',
            'rappel_minutes' => 'nullable|integer|min:0',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['couleur'] = $validated['couleur'] ?? '#3498db';
        $validated['rappel_minutes'] = $validated['rappel_minutes'] ?? 15;

        Event::create($validated);

        return response()->json(['success' => true, 'message' => 'Événement créé']);
    }

    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:tache,reunion,personnel,projet',
            'couleur' => 'nullable|string|max:7',
            'lieu' => 'nullable|string|max:255',
        ]);

        $event->update($validated);

        return response()->json(['success' => true, 'message' => 'Événement mis à jour']);
    }

    public function destroy(Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $event->delete();

        return response()->json(['success' => true, 'message' => 'Événement supprimé']);
    }
}

