@extends('layouts.dashboard')

@section('title', 'Nouveau Message')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-envelope-plus"></i> Nouveau Message</h2>
    <a href="{{ route('messages.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('messages.store') }}">
            @csrf
            <div class="mb-3">
                <label for="destinataire_id" class="form-label">Destinataire <span class="text-danger">*</span></label>
                <select class="form-select @error('destinataire_id') is-invalid @enderror" 
                        id="destinataire_id" name="destinataire_id" required>
                    <option value="">Sélectionner un destinataire</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('destinataire_id', $selected_user?->id) == $user->id ? 'selected' : '' }}>
                        {{ $user->full_name }} ({{ $user->email }})
                    </option>
                    @endforeach
                </select>
                @error('destinataire_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="task_id" class="form-label">Lier à une tâche (optionnel)</label>
                <select class="form-select @error('task_id') is-invalid @enderror" id="task_id" name="task_id">
                    <option value="">Aucune tâche</option>
                    @foreach($tasks as $task)
                    <option value="{{ $task->id }}" {{ old('task_id', $selected_task?->id) == $task->id ? 'selected' : '' }}>
                        {{ $task->titre }}
                    </option>
                    @endforeach
                </select>
                @error('task_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sujet" class="form-label">Sujet</label>
                <input type="text" class="form-control @error('sujet') is-invalid @enderror" 
                       id="sujet" name="sujet" value="{{ old('sujet') }}">
                @error('sujet')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                <textarea class="form-control @error('message') is-invalid @enderror" 
                          id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('messages.index') }}" class="btn btn-secondary me-2">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> Envoyer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

