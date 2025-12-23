@extends('layouts.app')

@section('title', 'Tâches')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">
            <i class="bi bi-list-check text-primary"></i> Gestion des Tâches
        </h2>
        <p class="text-muted mb-0 mt-1">
            <i class="bi bi-info-circle"></i> Gérez toutes vos tâches en un seul endroit
        </p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Nouvelle Tâche
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('tasks.index') }}" class="row g-3">
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Rechercher une tâche..." 
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-flag"></i></span>
                    <select name="status" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="à faire" {{ request('status') == 'à faire' ? 'selected' : '' }}>À faire</option>
                        <option value="en cours" {{ request('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="terminé" {{ request('status') == 'terminé' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-exclamation-triangle"></i></span>
                    <select name="priority" class="form-select">
                        <option value="">Toutes priorités</option>
                        <option value="faible" {{ request('priority') == 'faible' ? 'selected' : '' }}>Faible</option>
                        <option value="moyenne" {{ request('priority') == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                        <option value="élevée" {{ request('priority') == 'élevée' ? 'selected' : '' }}>Élevée</option>
                        <option value="urgente" {{ request('priority') == 'urgente' ? 'selected' : '' }}>Urgente</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-tag"></i></span>
                    <select name="category" class="form-select">
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
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-funnel-fill"></i> Filtrer
                </button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                </a>
            </div>
        </form>
    </div>
    <div class="card-body">
        @if($tasks->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><i class="bi bi-file-text"></i> Titre</th>
                        <th><i class="bi bi-person"></i> Assigné à</th>
                        <th><i class="bi bi-flag"></i> Statut</th>
                        <th><i class="bi bi-exclamation-triangle"></i> Priorité</th>
                        <th><i class="bi bi-tag"></i> Catégorie</th>
                        <th><i class="bi bi-calendar-event"></i> Date fin</th>
                        <th><i class="bi bi-gear"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none fw-bold">
                                <i class="bi bi-file-earmark-text text-primary"></i> {{ $task->titre }}
                            </a>
                            @if($task->is_important)
                            <span class="badge bg-danger ms-2">
                                <i class="bi bi-star-fill"></i> Important
                            </span>
                            @endif
                        </td>
                        <td>
                            <i class="bi bi-person-circle text-secondary"></i> 
                            {{ $task->assignedUser->full_name }}
                        </td>
                        <td>
                            <span class="badge badge-status badge-{{ str_replace(' ', '-', $task->status) }}">
                                @if($task->status == 'à faire')
                                    <i class="bi bi-circle"></i>
                                @elseif($task->status == 'en cours')
                                    <i class="bi bi-arrow-repeat"></i>
                                @else
                                    <i class="bi bi-check-circle"></i>
                                @endif
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-priority-{{ $task->priority }}">
                                @if($task->priority == 'urgente')
                                    <i class="bi bi-fire"></i>
                                @elseif($task->priority == 'élevée')
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                @elseif($task->priority == 'moyenne')
                                    <i class="bi bi-dash-circle"></i>
                                @else
                                    <i class="bi bi-circle"></i>
                                @endif
                                {{ ucfirst($task->priority) }}
                            </span>
                        </td>
                        <td>
                            @if($task->category)
                            <span class="badge" style="background-color: {{ $task->category->color }}">
                                <i class="bi bi-tag-fill"></i> {{ $task->category->nom }}
                            </span>
                            @else
                            <span class="text-muted"><i class="bi bi-dash"></i></span>
                            @endif
                        </td>
                        <td>
                            @if($task->date_fin)
                            <i class="bi bi-calendar3 text-info"></i> {{ $task->date_fin->format('d/m/Y') }}
                            @if($task->isOverdue())
                            <span class="badge bg-danger ms-1">
                                <i class="bi bi-clock-history"></i> En retard
                            </span>
                            @endif
                            @else
                            <span class="text-muted"><i class="bi bi-dash"></i></span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-primary" title="Voir">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @can('update', $task)
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning" title="Modifier">
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
        <div class="mt-3">
            {{ $tasks->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox display-1 text-muted"></i>
            <p class="text-muted mt-3">Aucune tâche trouvée.</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i> Créer votre première tâche
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

