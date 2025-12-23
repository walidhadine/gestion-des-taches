@extends('layouts.app')

@section('title', 'Nouvel Utilisateur')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-plus"></i> Nouvel Utilisateur</h2>
    <a href="{{ route('admin.users') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                           id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                    @error('prenom')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                           id="nom" name="nom" value="{{ old('nom') }}" required>
                    @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rôle <span class="text-danger">*</span></label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary me-2">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Créer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

