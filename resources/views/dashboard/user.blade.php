@extends('layouts.dashboard')

@section('title', 'Dashboard - TaskFlow')

@section('content')
<!-- Enhanced Dashboard Header -->
<div class="dashboard-header position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 20px; padding: 2.5rem;">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
        <i class="bi bi-speedometer2" style="font-size: 200px;"></i>
    </div>
    <div class="position-absolute bottom-0 start-0 opacity-10" style="transform: translate(-20%, 20%);">
        <i class="bi bi-graph-up" style="font-size: 150px;"></i>
    </div>
    <div class="position-relative z-1">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-white">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="bi bi-speedometer2 me-3"></i>Tableau de Bord
                </h1>
                <p class="text-white-50 mb-0 fs-5">
                    <i class="bi bi-person-circle me-2"></i>Bienvenue, <strong>{{ auth()->user()->full_name }}</strong>!
                </p>
                <div class="mt-3">
                    <span class="badge bg-white bg-opacity-20 text-white px-3 py-2">
                        <i class="bi bi-calendar3 me-2"></i>{{ now()->format('d F Y') }}
                    </span>
                    <span class="badge bg-white bg-opacity-20 text-white px-3 py-2 ms-2">
                        <i class="bi bi-clock me-2"></i>{{ now()->format('H:i') }}
                    </span>
                </div>
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

<!-- Enhanced Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-list-task me-2"></i> Mes Tâches
                        </h6>
                        <h2 class="mb-0 fw-bold display-6">{{ $stats['my_tasks'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-1">Total assignées</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 rounded-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-list-check fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-circle me-2"></i> À Faire
                        </h6>
                        <h2 class="mb-0 fw-bold display-6">{{ $stats['tasks_todo'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-1">En attente</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 rounded-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-circle-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-arrow-repeat me-2"></i> En Cours
                        </h6>
                        <h2 class="mb-0 fw-bold display-6">{{ $stats['tasks_in_progress'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-1">Actives</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 rounded-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-arrow-repeat fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-check-circle me-2"></i> Terminées
                        </h6>
                        <h2 class="mb-0 fw-bold display-6">{{ $stats['tasks_completed'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-1">Complétées</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 rounded-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-check-circle-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($stats['overdue_tasks'] > 0)
<div class="alert alert-danger border-0 shadow-lg rounded-4 mb-4" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%); border-left: 4px solid #ef4444;">
    <div class="d-flex align-items-center">
        <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-20 rounded-3 me-3" style="width: 50px; height: 50px;">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i>
        </div>
        <div class="flex-grow-1">
            <h5 class="mb-1 text-danger fw-bold">
                <i class="bi bi-exclamation-triangle me-2"></i> Tâches en retard
            </h5>
            <p class="mb-0 text-danger">
                Vous avez <strong>{{ $stats['overdue_tasks'] }}</strong> tâche(s) en retard!
            </p>
        </div>
        <a href="{{ route('tasks.index', ['status' => 'en cours']) }}" class="btn btn-danger btn-sm">
            <i class="bi bi-arrow-right me-1"></i> Voir les tâches
        </a>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-list-task text-primary me-2"></i> Mes Tâches Récentes
                </h5>
            </div>
            <div class="card-body p-0">
                @if($my_tasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><i class="bi bi-file-text me-1"></i> Titre</th>
                                <th><i class="bi bi-flag me-1"></i> Statut</th>
                                <th><i class="bi bi-exclamation-triangle me-1"></i> Priorité</th>
                                <th><i class="bi bi-calendar-event me-1"></i> Date fin</th>
                                <th><i class="bi bi-gear me-1"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($my_tasks as $task)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-2 me-2" style="width: 32px; height: 32px;">
                                            <i class="bi bi-file-earmark-text text-primary small"></i>
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
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-3 mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-inbox text-muted fs-2"></i>
                    </div>
                    <p class="text-muted">Aucune tâche pour le moment.</p>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill me-2"></i> Créer votre première tâche
                    </a>
                    @else
                    <p class="text-muted small">Contactez votre administrateur pour créer des tâches.</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-bell text-warning me-2"></i> Notifications
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-20 rounded-3 me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-bell-fill text-warning fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold">{{ $unread_notifications }}</h6>
                        <p class="text-muted small mb-0">Notification(s) non lue(s)</p>
                    </div>
                </div>
                <a href="{{ route('notifications.index') }}" class="btn btn-warning w-100">
                    <i class="bi bi-eye me-2"></i> Voir toutes les notifications
                </a>
            </div>
        </div>
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-envelope text-info me-2"></i> Messages
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-20 rounded-3 me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-envelope-fill text-info fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold">{{ $unread_messages }}</h6>
                        <p class="text-muted small mb-0">Message(s) non lu(s)</p>
                    </div>
                </div>
                <a href="{{ route('messages.index') }}" class="btn btn-info w-100">
                    <i class="bi bi-eye me-2"></i> Voir mes messages
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
    .ls-1 {
        letter-spacing: 1px;
    }
    .dashboard-header {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection

