@extends('layouts.dashboard')

@section('title', 'Dashboard Administrateur - TaskFlow')

@section('content')
<!-- Enhanced Admin Dashboard Header -->
<div class="admin-dashboard-header position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 20px; padding: 2.5rem;">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
        <i class="bi bi-shield-check" style="font-size: 200px;"></i>
    </div>
    <div class="position-absolute bottom-0 start-0 opacity-10" style="transform: translate(-20%, 20%);">
        <i class="bi bi-graph-up" style="font-size: 150px;"></i>
    </div>
    <div class="position-relative z-1">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-white">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="bi bi-shield-check me-3"></i>Dashboard Administrateur
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
                            <i class="bi bi-list-task me-2"></i> Total Tâches
                        </h6>
                        <h2 class="fw-bold mb-0">{{ $stats['total_tasks'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">
                            <i class="bi bi-arrow-up"></i> Vue d'ensemble
                        </p>
                    </div>
                    <div class="text-white-20">
                        <i class="bi bi-list-check" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-clock me-2"></i> À Faire
                        </h6>
                        <h2 class="fw-bold mb-0">{{ $stats['tasks_todo'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">
                            <i class="bi bi-hourglass-split"></i> En attente
                        </p>
                    </div>
                    <div class="text-white-20">
                        <i class="bi bi-circle" style="font-size: 2.5rem;"></i>
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
                        <h2 class="fw-bold mb-0">{{ $stats['tasks_in_progress'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">
                            <i class="bi bi-activity"></i> Actives
                        </p>
                    </div>
                    <div class="text-white-20">
                        <i class="bi bi-arrow-repeat" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-check-circle me-2"></i> Terminées
                        </h6>
                        <h2 class="fw-bold mb-0">{{ $stats['tasks_completed'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">
                            <i class="bi bi-trophy"></i> Accomplies
                        </p>
                    </div>
                    <div class="text-white-20">
                        <i class="bi bi-check-circle" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats Row -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-exclamation-triangle me-2"></i> Tâches en Retard
                        </h6>
                        <h2 class="fw-bold mb-0">{{ $stats['overdue_tasks'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">
                            <i class="bi bi-clock-history"></i> Urgent
                        </p>
                    </div>
                    <div class="text-white-20">
                        <i class="bi bi-exclamation-triangle-fill" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-people me-2"></i> Total Utilisateurs
                        </h6>
                        <h2 class="fw-bold mb-0">{{ $stats['total_users'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">
                            <i class="bi bi-person-badge"></i> Inscrits
                        </p>
                    </div>
                    <div class="text-white-20">
                        <i class="bi bi-people-fill" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-person-check me-2"></i> Utilisateurs Actifs
                        </h6>
                        <h2 class="fw-bold mb-0">{{ $stats['active_users'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-2">
                            <i class="bi bi-lightning"></i> Connectés
                        </p>
                    </div>
                    <div class="text-white-20">
                        <i class="bi bi-person-check-fill" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities Section -->
<div class="row g-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-list-task text-primary me-2"></i>Tâches Récentes
                </h5>
            </div>
            <div class="card-body p-0">
                @if($recent_tasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th><i class="bi bi-file-text me-1"></i> Titre</th>
                                <th><i class="bi bi-person me-1"></i> Assigné à</th>
                                <th><i class="bi bi-flag me-1"></i> Statut</th>
                                <th><i class="bi bi-calendar-event me-1"></i> Date</th>
                                <th><i class="bi bi-gear me-1"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_tasks as $task)
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
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar3 text-info me-2"></i>
                                        <span>{{ $task->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-primary rounded-2" title="Voir">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning rounded-2" title="Modifier">
                                            <i class="bi bi-pencil-fill"></i>
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
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-3 mb-4" style="width: 120px; height: 120px;">
                        <i class="bi bi-inbox text-muted fs-1"></i>
                    </div>
                    <h4 class="text-muted mb-3">Aucune tâche récente</h4>
                    <p class="text-muted">Les tâches apparaîtront ici dès qu'elles seront créées.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-people text-primary me-2"></i>Utilisateurs Récents
                </h5>
            </div>
            <div class="card-body p-4">
                @if($recent_users->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($recent_users as $user)
                    <div class="list-group-item px-0 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-person text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold text-dark">{{ $user->full_name }}</h6>
                                <p class="mb-0 text-muted small">{{ $user->email }}</p>
                            </div>
                            <div>
                                <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }} px-3 py-2">
                                    <i class="bi bi-{{ $user->is_active ? 'circle-fill' : 'circle' }}"></i>
                                    {{ $user->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-3 mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-people text-muted fs-3"></i>
                    </div>
                    <h6 class="text-muted mb-2">Aucun utilisateur récent</h6>
                    <p class="text-muted small">Les nouveaux utilisateurs apparaîtront ici.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.hover-scale {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-scale:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
}
.admin-dashboard-header {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
}
.text-white-20 {
    opacity: 0.2;
}
.ls-1 {
    letter-spacing: 0.05em;
}
</style>
@endsection
