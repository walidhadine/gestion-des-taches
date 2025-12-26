@extends('layouts.dashboard')

@section('title', 'Modifier la Tâche')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil"></i> Modifier la Tâche</h2>
    <a href="{{ route('tasks.show', $task) }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                           id="titre" name="titre" value="{{ old('titre', $task->titre) }}" required>
                    @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="à faire" {{ old('status', $task->status) == 'à faire' ? 'selected' : '' }}>À faire</option>
                        <option value="en cours" {{ old('status', $task->status) == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="terminé" {{ old('status', $task->status) == 'terminé' ? 'selected' : '' }}>Terminé</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="assigned_to" class="form-label">Assigné à <span class="text-danger">*</span></label>
                    <select class="form-select @error('assigned_to') is-invalid @enderror" 
                            id="assigned_to" name="assigned_to" required>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                            {{ $user->full_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('assigned_to')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                        <option value="">Aucune catégorie</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->nom }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="priority" class="form-label">Priorité <span class="text-danger">*</span></label>
                    <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                        <option value="faible" {{ old('priority', $task->priority) == 'faible' ? 'selected' : '' }}>Faible</option>
                        <option value="moyenne" {{ old('priority', $task->priority) == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                        <option value="élevée" {{ old('priority', $task->priority) == 'élevée' ? 'selected' : '' }}>Élevée</option>
                        <option value="urgente" {{ old('priority', $task->priority) == 'urgente' ? 'selected' : '' }}>Urgente</option>
                    </select>
                    @error('priority')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <input type="date" class="form-control @error('date_debut') is-invalid @enderror" 
                           id="date_debut" name="date_debut" value="{{ old('date_debut', $task->date_debut?->format('Y-m-d')) }}">
                    @error('date_debut')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" class="form-control @error('date_fin') is-invalid @enderror" 
                           id="date_fin" name="date_fin" value="{{ old('date_fin', $task->date_fin?->format('Y-m-d')) }}">
                    @error('date_fin')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="completion_percentage" class="form-label">Progression (%)</label>
                    <input type="number" class="form-control @error('completion_percentage') is-invalid @enderror" 
                           id="completion_percentage" name="completion_percentage" 
                           value="{{ old('completion_percentage', $task->completion_percentage) }}" min="0" max="100">
                    @error('completion_percentage')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="fichier_joint" class="form-label">Fichier joint</label>
                    <input type="file" class="form-control @error('fichier_joint') is-invalid @enderror" 
                           id="fichier_joint" name="fichier_joint">
                    @error('fichier_joint')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($task->fichier_joint)
                    <small class="text-muted">Fichier actuel: <a href="{{ asset('storage/' . $task->fichier_joint) }}" target="_blank">Voir</a></small>
                    @endif
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="hidden" name="is_important" value="0">
                <input type="checkbox" class="form-check-input" id="is_important" name="is_important" 
                       value="1" {{ old('is_important', $task->is_important) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_important">Marquer comme important</label>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" 
                          id="notes" name="notes" rows="3">{{ old('notes', $task->notes) }}</textarea>
                @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('tasks.show', $task) }}" class="btn btn-secondary me-2">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

