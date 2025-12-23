@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">
            <i class="bi bi-speedometer2 text-primary"></i> Dashboard
        </h2>
        <p class="text-muted mb-0 mt-1">
            <i class="bi bi-person-circle"></i> Bienvenue, <strong>{{ auth()->user()->full_name }}</strong>!
        </p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Nouvelle Tâche
    </a>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2">
                            <i class="bi bi-list-task"></i> Mes Tâches
                        </h6>
                        <h2 class="mb-0 fw-bold">{{ $stats['my_tasks'] }}</h2>
                    </div>
                    <i class="bi bi-list-check display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2">
                            <i class="bi bi-circle"></i> À Faire
                        </h6>
                        <h2 class="mb-0 fw-bold">{{ $stats['tasks_todo'] }}</h2>
                    </div>
                    <i class="bi bi-circle-fill display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2">
                            <i class="bi bi-arrow-repeat"></i> En Cours
                        </h6>
                        <h2 class="mb-0 fw-bold">{{ $stats['tasks_in_progress'] }}</h2>
                    </div>
                    <i class="bi bi-arrow-repeat display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2">
                            <i class="bi bi-check-circle"></i> Terminées
                        </h6>
                        <h2 class="mb-0 fw-bold">{{ $stats['tasks_completed'] }}</h2>
                    </div>
                    <i class="bi bi-check-circle-fill display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@if($stats['overdue_tasks'] > 0)
<div class="alert alert-danger border-0 shadow-sm mt-4">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill display-6 me-3"></i>
        <div>
            <h5 class="mb-1">Tâches en retard</h5>
            <p class="mb-0">Vous avez <strong>{{ $stats['overdue_tasks'] }}</strong> tâche(s) en retard!</p>
        </div>
    </div>
</div>
@endif

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-list-task"></i> Mes Tâches Récentes</h5>
            </div>
            <div class="card-body">
                @if($my_tasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Statut</th>
                                <th>Priorité</th>
                                <th>Date fin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($my_tasks as $task)
                            <tr>
                                <td>
                                    <a href="{{ route('tasks.show', $task) }}">{{ $task->titre }}</a>
                                    @if($task->is_important)
                                    <span class="badge bg-danger">Important</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-status badge-{{ str_replace(' ', '-', $task->status) }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-priority-{{ $task->priority }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </td>
                                <td>{{ $task->date_fin ? $task->date_fin->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">Aucune tâche pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-bell"></i> Notifications</h5>
            </div>
            <div class="card-body">
                <p>Vous avez <strong>{{ $unread_notifications }}</strong> notification(s) non lue(s)</p>
                <a href="{{ route('notifications.index') }}" class="btn btn-primary btn-sm">
                    Voir toutes les notifications
                </a>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-envelope"></i> Messages</h5>
            </div>
            <div class="card-body">
                <p>Vous avez <strong>{{ $unread_messages }}</strong> message(s) non lu(s)</p>
                <a href="{{ route('messages.index') }}" class="btn btn-primary btn-sm">
                    Voir mes messages
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

