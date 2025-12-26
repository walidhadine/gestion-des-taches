@extends('layouts.dashboard')

@section('title', 'Gestion des Utilisateurs - TaskFlow')

@section('content')
<!-- Enhanced Users Header -->
<div class="users-header position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 20px; padding: 2rem;">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
        <i class="bi bi-people" style="font-size: 200px;"></i>
    </div>
    <div class="position-relative z-1">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-white">
                <h1 class="display-5 fw-bold mb-2">
                    <i class="bi bi-people me-3"></i>Gestion des Utilisateurs
                </h1>
                <p class="text-white-50 mb-0 fs-5">
                    <i class="bi bi-shield-check me-2"></i>Administrer tous les utilisateurs du système
                </p>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('admin.users.create') }}" class="btn btn-warning btn-lg px-4 shadow-lg hover-scale">
                    <i class="bi bi-plus-circle-fill me-2"></i> Nouvel Utilisateur
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Users Table -->
<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
    <div class="card-header bg-white border-bottom p-4">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-people-fill text-success me-2"></i>Liste des Utilisateurs
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th><i class="bi bi-person me-1"></i> Nom</th>
                        <th><i class="bi bi-envelope me-1"></i> Email</th>
                        <th><i class="bi bi-shield me-1"></i> Rôle</th>
                        <th><i class="bi bi-toggle-on me-1"></i> Statut</th>
                        <th><i class="bi bi-clock-history me-1"></i> Dernière connexion</th>
                        <th><i class="bi bi-gear me-1"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person-fill text-success"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark">{{ $user->full_name }}</span>
                                    <div class="text-muted small">ID: {{ $user->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope-fill text-info me-2"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge px-3 py-2 {{ $user->role == 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                @if($user->role == 'admin')
                                    <i class="bi bi-shield-fill me-1"></i> Administrateur
                                @else
                                    <i class="bi bi-person me-1"></i> Utilisateur
                                @endif
                            </span>
                        </td>
                        <td>
                            <span class="badge px-3 py-2 {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                @if($user->is_active)
                                    <i class="bi bi-check-circle-fill me-1"></i> Actif
                                @else
                                    <i class="bi bi-x-circle-fill me-1"></i> Inactif
                                @endif
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock-fill text-secondary me-2"></i>
                                <span>{{ $user->last_login ? $user->last_login->format('d/m/Y H:i') : 'Jamais' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning rounded-2" title="Modifier">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-top">
            {{ $users->links() }}
        </div>
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
    .users-header {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection

