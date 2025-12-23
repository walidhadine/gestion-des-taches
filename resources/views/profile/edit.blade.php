@extends('layouts.app')

@section('title', 'Modifier le Profil')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil"></i> Modifier le Profil</h2>
    <a href="{{ route('profile.show') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informations Personnelles</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
                            @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required>
                            @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" value="{{ old('telephone', $user->profile->telephone ?? '') }}">
                            @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="poste" class="form-label">Poste</label>
                            <input type="text" class="form-control @error('poste') is-invalid @enderror" 
                                   id="poste" name="poste" value="{{ old('poste', $user->profile->poste ?? '') }}">
                            @error('poste')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="departement" class="form-label">Département</label>
                            <input type="text" class="form-control @error('departement') is-invalid @enderror" 
                                   id="departement" name="departement" value="{{ old('departement', $user->profile->departement ?? '') }}">
                            @error('departement')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bureau" class="form-label">Bureau</label>
                            <input type="text" class="form-control @error('bureau') is-invalid @enderror" 
                                   id="bureau" name="bureau" value="{{ old('bureau', $user->profile->bureau ?? '') }}">
                            @error('bureau')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                  id="bio" name="bio" rows="3">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                        @error('bio')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" 
                               id="avatar" name="avatar" accept="image/*">
                        @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="theme" class="form-label">Thème <span class="text-danger">*</span></label>
                            <select class="form-select @error('theme') is-invalid @enderror" id="theme" name="theme" required>
                                <option value="clair" {{ old('theme', $user->profile->theme ?? 'clair') == 'clair' ? 'selected' : '' }}>Clair</option>
                                <option value="sombre" {{ old('theme', $user->profile->theme ?? 'clair') == 'sombre' ? 'selected' : '' }}>Sombre</option>
                                <option value="auto" {{ old('theme', $user->profile->theme ?? 'clair') == 'auto' ? 'selected' : '' }}>Auto</option>
                            </select>
                            @error('theme')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="langue" class="form-label">Langue <span class="text-danger">*</span></label>
                            <select class="form-select @error('langue') is-invalid @enderror" id="langue" name="langue" required>
                                <option value="fr" {{ old('langue', $user->profile->langue ?? 'fr') == 'fr' ? 'selected' : '' }}>Français</option>
                                <option value="en" {{ old('langue', $user->profile->langue ?? 'fr') == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                            @error('langue')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="notifications_email" name="notifications_email" 
                               {{ old('notifications_email', $user->profile->notifications_email ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notifications_email">Notifications par email</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="notifications_app" name="notifications_app" 
                               {{ old('notifications_app', $user->profile->notifications_app ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notifications_app">Notifications dans l'application</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary me-2">Annuler</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Changer le mot de passe</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" name="current_password" required>
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">
                        <i class="bi bi-key"></i> Changer le mot de passe
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

