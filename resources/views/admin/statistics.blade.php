@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-graph-up"></i> Statistiques</h2>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Tâches</h5>
                <h2>{{ $stats['total_tasks'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">À Faire</h5>
                <h2>{{ $stats['tasks_todo'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">En Cours</h5>
                <h2>{{ $stats['tasks_in_progress'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Terminées</h5>
                <h2>{{ $stats['tasks_completed'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Répartition par Statut</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Répartition par Priorité</h5>
            </div>
            <div class="card-body">
                <canvas id="priorityChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Tâches Récentes</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Assigné à</th>
                        <th>Statut</th>
                        <th>Date création</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_tasks as $task)
                    <tr>
                        <td>{{ $task->titre }}</td>
                        <td>{{ $task->assignedUser->full_name }}</td>
                        <td>
                            <span class="badge badge-status badge-{{ str_replace(' ', '-', $task->status) }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td>{{ $task->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
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

