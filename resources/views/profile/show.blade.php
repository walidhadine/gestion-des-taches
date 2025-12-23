@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-circle"></i> Mon Profil</h2>
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
        <i class="bi bi-pencil"></i> Modifier
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ asset('storage/avatars/' . ($user->profile->avatar ?? 'default-avatar.png')) }}" 
                     alt="Avatar" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                <h4>{{ $user->full_name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informations Personnelles</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Prénom:</strong> {{ $user->prenom }}
                    </div>
                    <div class="col-md-6">
                        <strong>Nom:</strong> {{ $user->nom }}
                    </div>
                </div>
                @if($user->profile)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Téléphone:</strong> {{ $user->profile->telephone ?: '-' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Poste:</strong> {{ $user->profile->poste ?: '-' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Département:</strong> {{ $user->profile->departement ?: '-' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Bureau:</strong> {{ $user->profile->bureau ?: '-' }}
                    </div>
                </div>
                @if($user->profile->bio)
                <div class="mb-3">
                    <strong>Bio:</strong>
                    <p>{{ $user->profile->bio }}</p>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

