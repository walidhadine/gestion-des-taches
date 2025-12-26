@extends('layouts.dashboard')

@section('title', 'Mon Profil - TaskFlow')

@section('content')
<!-- Enhanced Profile Header -->
<div class="profile-header position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 20px; padding: 2rem;">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
        <i class="bi bi-person-circle" style="font-size: 200px;"></i>
    </div>
    <div class="position-relative z-1">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-white">
                <h1 class="display-5 fw-bold mb-2">
                    <i class="bi bi-person-circle me-3"></i>Mon Profil
                </h1>
                <p class="text-white-50 mb-0 fs-5">
                    <i class="bi bi-person-badge me-2"></i>Gérez vos informations personnelles
                </p>
            </div>
            <div class="d-flex gap-3">
                <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-lg px-4 shadow-lg hover-scale">
                    <i class="bi bi-pencil-fill me-2"></i> Modifier
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Profile Content -->
<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark text-center">
                    <i class="bi bi-person-badge-fill text-purple me-2"></i>Photo de Profil
                </h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="position-relative d-inline-block mb-3">
                    <img src="{{ asset('storage/avatars/' . ($user->profile->avatar ?? 'default-avatar.png')) }}" 
                         alt="Avatar" class="rounded-circle shadow-lg" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #8b5cf6;">
                    <div class="position-absolute bottom-0 end-0 bg-purple text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border: 3px solid white;">
                        <i class="bi bi-camera-fill"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-1">{{ $user->full_name }}</h4>
                <p class="text-muted mb-3">{{ $user->email }}</p>
                <span class="badge px-3 py-2 {{ $user->role == 'admin' ? 'bg-danger' : 'bg-primary' }}">
                    @if($user->role == 'admin')
                        <i class="bi bi-shield-fill me-1"></i> Administrateur
                    @else
                        <i class="bi bi-person me-1"></i> Utilisateur
                    @endif
                </span>
                <div class="mt-4 pt-4 border-top">
                    <div class="d-flex justify-content-around text-center">
                        <div>
                            <h6 class="fw-bold text-purple mb-0">{{ $user->tasks ? $user->tasks->count() : 0 }}</h6>
                            <small class="text-muted">Tâches</small>
                        </div>
                        <div>
                            <h6 class="fw-bold text-purple mb-0">{{ $user->tasks ? $user->tasks->where('status', 'terminé')->count() : 0 }}</h6>
                            <small class="text-muted">Terminées</small>
                        </div>
                        <div>
                            <h6 class="fw-bold text-purple mb-0">{{ $user->created_at->format('Y') }}</h6>
                            <small class="text-muted">Membre depuis</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-person-lines-fill text-purple me-2"></i>Informations Personnelles
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-fill text-purple"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Prénom</small>
                                <span class="fw-bold text-dark">{{ $user->prenom }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-badge text-purple"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Nom</small>
                                <span class="fw-bold text-dark">{{ $user->nom }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if($user->profile)
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-telephone-fill text-purple"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Téléphone</small>
                                <span class="fw-bold text-dark">{{ $user->profile->telephone ?: 'Non spécifié' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-briefcase-fill text-purple"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Poste</small>
                                <span class="fw-bold text-dark">{{ $user->profile->poste ?: 'Non spécifié' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-building text-purple"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Département</small>
                                <span class="fw-bold text-dark">{{ $user->profile->departement ?: 'Non spécifié' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="d-inline-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-door-open text-purple"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Bureau</small>
                                <span class="fw-bold text-dark">{{ $user->profile->bureau ?: 'Non spécifié' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if($user->profile->bio)
                <div class="border-top pt-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-2 me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-card-text text-purple"></i>
                        </div>
                        <div class="flex-grow-1">
                            <small class="text-muted d-block mb-2">Bio</small>
                            <p class="text-dark mb-0">{{ $user->profile->bio }}</p>
                        </div>
                    </div>
                </div>
                @endif
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
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
    .profile-header {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
    .text-purple {
        color: #8b5cf6 !important;
    }
    .bg-purple {
        background-color: #8b5cf6 !important;
    }
</style>
@endsection

