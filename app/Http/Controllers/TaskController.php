<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use App\Models\TaskHistory;
use App\Models\TaskComment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Task::with(['assignedUser', 'creator', 'category']);

        if ($user->isUser()) {
            $query->where('assigned_to', $user->id);
        }

        // Filtres
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority') && $request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $tasks = $query->latest()->paginate(15);
        $categories = Category::all();
        $users = User::where('is_active', true)->get();

        return view('tasks.index', compact('tasks', 'categories', 'users'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::where('is_active', true)->get();
        return view('tasks.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:à faire,en cours,terminé',
            'priority' => 'required|in:faible,moyenne,élevée,urgente',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'heure_debut' => 'nullable',
            'heure_fin' => 'nullable',
            'assigned_to' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'is_important' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'fichier_joint' => 'nullable|file|max:10240',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['is_important'] = $request->input('is_important') === '1' || $request->input('is_important') === true || $request->input('is_important') === 1;

        if ($request->hasFile('fichier_joint')) {
            $validated['fichier_joint'] = $request->file('fichier_joint')->store('tasks', 'public');
        }

        $task = Task::create($validated);

        // Historique
        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'action' => 'création',
            'nouvelle_valeur' => 'Tâche créée',
        ]);

        // Notification
        Notification::create([
            'user_id' => $validated['assigned_to'],
            'type' => 'nouvelle_tache',
            'titre' => 'Nouvelle tâche assignée',
            'contenu' => "Vous avez été assigné à la tâche: {$task->titre}",
            'lien' => route('tasks.show', $task->id),
            'data' => ['task_id' => $task->id],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès!');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        
        $task->load(['assignedUser', 'creator', 'category', 'comments' => function($query) {
            $query->with('user')->orderBy('date_comment', 'desc');
        }, 'history.user']);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        
        $categories = Category::all();
        $users = User::where('is_active', true)->get();
        return view('tasks.edit', compact('task', 'categories', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:à faire,en cours,terminé',
            'priority' => 'required|in:faible,moyenne,élevée,urgente',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'heure_debut' => 'nullable',
            'heure_fin' => 'nullable',
            'assigned_to' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'is_important' => 'nullable|boolean',
            'completion_percentage' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string',
            'fichier_joint' => 'nullable|file|max:10240',
        ]);

        $oldStatus = $task->status;
        $validated['is_important'] = $request->input('is_important') === '1' || $request->input('is_important') === true || $request->input('is_important') === 1;

        if ($request->hasFile('fichier_joint')) {
            if ($task->fichier_joint) {
                Storage::disk('public')->delete($task->fichier_joint);
            }
            $validated['fichier_joint'] = $request->file('fichier_joint')->store('tasks', 'public');
        }

        $task->update($validated);

        // Historique si changement de statut
        if ($oldStatus !== $validated['status']) {
            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'action' => 'changement_statut',
                'ancienne_valeur' => $oldStatus,
                'nouvelle_valeur' => $validated['status'],
            ]);

            // Notification
            Notification::create([
                'user_id' => $task->assigned_to,
                'type' => 'statut_change',
                'titre' => 'Statut de tâche modifié',
                'contenu' => "Le statut de la tâche '{$task->titre}' a été modifié: {$oldStatus} → {$validated['status']}",
                'lien' => route('tasks.show', $task->id),
            ]);
        }

        return redirect()->route('tasks.show', $task)->with('success', 'Tâche mise à jour!');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        if ($task->fichier_joint) {
            Storage::disk('public')->delete($task->fichier_joint);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée!');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'status' => 'required|in:à faire,en cours,terminé',
        ]);

        $oldStatus = $task->status;
        $task->update(['status' => $request->status]);

        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'action' => 'changement_statut',
            'ancienne_valeur' => $oldStatus,
            'nouvelle_valeur' => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'Statut mis à jour']);
    }

    public function storeComment(Request $request, Task $task)
    {
        $this->authorize('view', $task);

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'fichier_joint' => 'nullable|file|max:10240',
        ]);

        // Créer le commentaire
        $commentData = [
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'comment' => $validated['comment'],
        ];

        if ($request->hasFile('fichier_joint')) {
            $commentData['fichier_joint'] = $request->file('fichier_joint')->store('task-comments', 'public');
        }

        TaskComment::create($commentData);

        // Changer automatiquement le statut à "terminé" si ce n'est pas déjà le cas
        if ($task->status !== 'terminé') {
            $oldStatus = $task->status;
            $task->update(['status' => 'terminé']);

            // Ajouter à l'historique
            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'action' => 'changement_statut',
                'ancienne_valeur' => $oldStatus,
                'nouvelle_valeur' => 'terminé',
            ]);

            // Notification au créateur de la tâche
            if ($task->created_by !== Auth::id()) {
                Notification::create([
                    'user_id' => $task->created_by,
                    'type' => 'tache_terminee',
                    'titre' => 'Tâche terminée',
                    'contenu' => "La tâche '{$task->titre}' a été marquée comme terminée par {$task->assignedUser->full_name}",
                    'lien' => route('tasks.show', $task->id),
                    'data' => ['task_id' => $task->id],
                ]);
            }
        }

        return redirect()->route('tasks.show', $task)->with('success', 'Votre réponse a été ajoutée et la tâche a été marquée comme terminée!');
    }
}

