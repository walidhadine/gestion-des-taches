@extends('layouts.dashboard')

@section('title', 'Tâches - TaskFlow')

@section('content')
<!-- Enhanced Tasks Header -->
<div class="tasks-header position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 20px; padding: 2rem;">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
        <i class="bi bi-list-check" style="font-size: 200px;"></i>
    </div>
    <div class="position-relative z-1">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-white">
                <h1 class="display-5 fw-bold mb-2">
                    <i class="bi bi-list-check me-3"></i>Gestion des Tâches
                </h1>
                <p class="text-white-50 mb-0 fs-5">
                    <i class="bi bi-info-circle me-2"></i>Gérez toutes vos tâches en un seul endroit
                </p>
            </div>
            <div class="d-flex gap-3">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('tasks.create') }}" class="btn btn-warning btn-lg px-4 shadow-lg hover-scale">
                    <i class="bi bi-plus-circle-fill me-2"></i> Nouvelle Tâche
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Filter Section -->
<div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white border-bottom p-4">
        <form method="GET" action="{{ route('tasks.index') }}" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label text-muted small fw-bold text-uppercase">Recherche</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-search text-primary"></i>
                    </span>
                    <input type="text" name="search" class="form-control bg-light border-start-0 ps-0" 
                           placeholder="Rechercher une tâche..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold text-uppercase">Statut</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-flag text-primary"></i>
                    </span>
                    <select name="status" class="form-select bg-light border-start-0">
                        <option value="">Tous les statuts</option>
                        <option value="à faire" {{ request('status') == 'à faire' ? 'selected' : '' }}>À faire</option>
                        <option value="en cours" {{ request('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="terminé" {{ request('status') == 'terminé' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold text-uppercase">Priorité</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-exclamation-triangle text-primary"></i>
                    </span>
                    <select name="priority" class="form-select bg-light border-start-0">
                        <option value="">Toutes priorités</option>
                        <option value="faible" {{ request('priority') == 'faible' ? 'selected' : '' }}>Faible</option>
                        <option value="moyenne" {{ request('priority') == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                        <option value="élevée" {{ request('priority') == 'élevée' ? 'selected' : '' }}>Élevée</option>
                        <option value="urgente" {{ request('priority') == 'urgente' ? 'selected' : '' }}>Urgente</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label text-muted small fw-bold text-uppercase">Catégorie</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-tag text-primary"></i>
                    </span>
                    <select name="category" class="form-select bg-light border-start-0">
                        <option value="">Toutes catégories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->nom }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-funnel-fill me-2"></i> Filtrer
                    </button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-counterclockwise me-2"></i> Réinitialiser
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Enhanced Tasks Table -->
<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
    <div class="card-header bg-white border-bottom p-4">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-list-task text-primary me-2"></i>Liste des Tâches
        </h5>
    </div>
    <div class="card-body p-0">
        @if($tasks->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th><i class="bi bi-file-text me-1"></i> Titre</th>
                        <th><i class="bi bi-person me-1"></i> Assigné à</th>
                        <th><i class="bi bi-flag me-1"></i> Statut</th>
                        <th><i class="bi bi-exclamation-triangle me-1"></i> Priorité</th>
                        <th><i class="bi bi-tag me-1"></i> Catégorie</th>
                        <th><i class="bi bi-calendar-event me-1"></i> Date fin</th>
                        <th><i class="bi bi-gear me-1"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                                    <i class="bi bi-file-earmark-text text-primary"></i>
                                </div>
                                <div>
                                    <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none fw-bold text-dark">{{ $task->titre }}</a>
                                    @if($task->is_important)
                                    <span class="badge bg-danger ms-2">
                                        <i class="bi bi-star-fill"></i> Important
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-secondary bg-opacity-10 rounded-2 me-2" style="width: 32px; height: 32px;">
                                    <i class="bi bi-person-circle text-secondary"></i>
                                </div>
                                <span class="text-dark">{{ $task->assignedUser->full_name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-status badge-{{ str_replace(' ', '-', $task->status) }} px-3 py-2">
                                @if($task->status == 'à faire')
                                    <i class="bi bi-circle me-1"></i>
                                @elseif($task->status == 'en cours')
                                    <i class="bi bi-arrow-repeat me-1"></i>
                                @else
                                    <i class="bi bi-check-circle me-1"></i>
                                @endif
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-priority-{{ $task->priority }} px-3 py-2">
                                @if($task->priority == 'urgente')
                                    <i class="bi bi-fire me-1"></i>
                                @elseif($task->priority == 'élevée')
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                @elseif($task->priority == 'moyenne')
                                    <i class="bi bi-dash-circle me-1"></i>
                                @else
                                    <i class="bi bi-circle me-1"></i>
                                @endif
                                {{ ucfirst($task->priority) }}
                            </span>
                        </td>
                        <td>
                            @if($task->category)
                            <span class="badge px-3 py-2" style="background-color: {{ $task->category->color }};">
                                <i class="bi bi-tag-fill me-1"></i> {{ $task->category->nom }}
                            </span>
                            @else
                            <span class="text-muted"><i class="bi bi-dash"></i></span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar3 text-info me-2"></i>
                                <span>{{ $task->date_fin ? $task->date_fin->format('d/m/Y') : '-' }}</span>
                                @if($task->isOverdue())
                                <span class="badge bg-danger ms-2">
                                    <i class="bi bi-clock-history"></i> En retard
                                </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-primary rounded-2" title="Voir">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @if(auth()->user()->isUser() && $task->status != 'terminé')
                                <button onclick="window.location.href='{{ route('tasks.respond', $task) }}'" class="btn btn-sm btn-success rounded-2" title="Répondre">
                                    <i class="bi bi-reply-fill"></i>
                                </button>
                                @endif
                                @can('update', $task)
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning rounded-2" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-top">
            {{ $tasks->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-3 mb-4" style="width: 120px; height: 120px;">
                <i class="bi bi-inbox text-muted fs-1"></i>
            </div>
            <h4 class="text-muted mb-3">Aucune tâche trouvée</h4>
            <p class="text-muted mb-4">
                @if(auth()->user()->isAdmin())
                Commencez par créer votre première tâche pour organiser votre travail.
                @else
                Consultez les tâches assignées par votre administrateur.
                @endif
            </p>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-lg px-4">
                <i class="bi bi-plus-circle-fill me-2"></i> Créer votre première tâche
            </a>
            @endif
        </div>
        @endif
    </div>
</div>

<style>
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
    .tasks-header {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection

