@extends('layouts.dashboard')

@section('title', 'Statistiques - TaskFlow')

@section('content')
<!-- Enhanced Statistics Header -->
<div class="stats-header position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%); border-radius: 20px; padding: 2rem;">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
        <i class="bi bi-graph-up" style="font-size: 200px;"></i>
    </div>
    <div class="position-relative z-1">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-white">
                <h1 class="display-5 fw-bold mb-2">
                    <i class="bi bi-graph-up me-3"></i>Statistiques
                </h1>
                <p class="text-white-50 mb-0 fs-5">
                    <i class="bi bi-bar-chart-line me-2"></i>Analyse complète des performances et tendances
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body text-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2 small text-uppercase ls-1">
                            <i class="bi bi-list-task me-2"></i> Total Tâches
                        </h6>
                        <h2 class="mb-0 fw-bold display-6">{{ $stats['total_tasks'] }}</h2>
                        <p class="text-white-50 small mb-0 mt-1">Toutes les tâches</p>
                    </div>
                    <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 rounded-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-collection fs-3"></i>
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
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
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
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden hover-scale transition-all" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
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

<!-- Enhanced Charts Section -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-pie-chart-fill text-danger me-2"></i>Répartition par Statut
                </h5>
            </div>
            <div class="card-body p-4">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-bar-chart-fill text-warning me-2"></i>Répartition par Priorité
                </h5>
            </div>
            <div class="card-body p-4">
                <canvas id="priorityChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Recent Tasks Table -->
<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
    <div class="card-header bg-white border-bottom p-4">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-clock-history text-info me-2"></i>Tâches Récentes
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th><i class="bi bi-file-text me-1"></i> Titre</th>
                        <th><i class="bi bi-person me-1"></i> Assigné à</th>
                        <th><i class="bi bi-flag me-1"></i> Statut</th>
                        <th><i class="bi bi-calendar-event me-1"></i> Date création</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_tasks as $task)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-2 me-3" style="width: 32px; height: 32px;">
                                    <i class="bi bi-file-earmark-text text-primary"></i>
                                </div>
                                <span class="fw-bold text-dark">{{ $task->titre }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-secondary bg-opacity-10 rounded-2 me-2" style="width: 28px; height: 28px;">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
    .stats-header {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart pour les statuts
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['À faire', 'En cours', 'Terminé'],
            datasets: [{
                data: [
                    {{ $tasks_by_status['à faire'] ?? 0 }},
                    {{ $tasks_by_status['en cours'] ?? 0 }},
                    {{ $tasks_by_status['terminé'] ?? 0 }}
                ],
                backgroundColor: ['#95a5a6', '#3498db', '#2ecc71']
            }]
        }
    });

    // Chart pour les priorités
    const priorityCtx = document.getElementById('priorityChart').getContext('2d');
    new Chart(priorityCtx, {
        type: 'bar',
        data: {
            labels: ['Faible', 'Moyenne', 'Élevée', 'Urgente'],
            datasets: [{
                label: 'Nombre de tâches',
                data: [
                    {{ $tasks_by_priority['faible'] ?? 0 }},
                    {{ $tasks_by_priority['moyenne'] ?? 0 }},
                    {{ $tasks_by_priority['élevée'] ?? 0 }},
                    {{ $tasks_by_priority['urgente'] ?? 0 }}
                ],
                backgroundColor: ['#95a5a6', '#3498db', '#f39c12', '#e74c3c']
            }]
        }
    });
});
</script>
@endpush

