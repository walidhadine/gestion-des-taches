@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard Administrateur</h2>
    <span class="text-muted">Bienvenue, {{ auth()->user()->full_name }}!</span>
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
    <div class="col-md-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Tâches en Retard</h5>
                <h2>{{ $stats['overdue_tasks'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h5 class="card-title">Total Utilisateurs</h5>
                <h2>{{ $stats['total_users'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <h5 class="card-title">Utilisateurs Actifs</h5>
                <h2>{{ $stats['active_users'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-list-task"></i> Tâches Récentes</h5>
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
                                <th>Actions</th>
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
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-people"></i> Utilisateurs Récents</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($recent_users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $user->full_name }}
                        <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                            {{ $user->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

