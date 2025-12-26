@extends('layouts.dashboard')

@section('title', 'Répondre à la tâche - TaskFlow')

@section('content')
<!-- Enhanced Response Header -->
<div class="response-header position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 20px; padding: 2rem;">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
        <i class="bi bi-reply-fill" style="font-size: 200px;"></i>
    </div>
    <div class="position-relative z-1">
        <div class="text-white">
            <h1 class="display-5 fw-bold mb-2">
                <i class="bi bi-reply-fill me-3"></i>Répondre à la Tâche
            </h1>
            <p class="text-white-50 mb-0 fs-5">
                <i class="bi bi-info-circle me-2"></i>Ajoutez votre réponse et marquez la tâche comme terminée
            </p>
        </div>
    </div>
</div>

<!-- Task Details -->
<div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white border-bottom p-4">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-file-earmark-text text-primary me-2"></i>Détails de la Tâche
        </h5>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Titre</label>
                    <h4 class="text-dark fw-bold">{{ $task->titre }}</h4>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Description</label>
                    <p class="text-dark">{{ $task->description ?: 'Aucune description' }}</p>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="text-muted small fw-bold text-uppercase">Statut</label>
                        <div>
                            <span class="badge badge-status badge-{{ str_replace(' ', '-', $task->status) }} px-3 py-2">
                                {{ ucfirst($task->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small fw-bold text-uppercase">Priorité</label>
                        <div>
                            <span class="badge badge-priority-{{ $task->priority }} px-3 py-2">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small fw-bold text-uppercase">Date fin</label>
                        <div class="text-dark">
                            {{ $task->date_fin ? $task->date_fin->format('d/m/Y') : '-' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-light rounded-3 p-3">
                    <h6 class="fw-bold text-dark mb-3">Informations</h6>
                    <div class="mb-2">
                        <small class="text-muted">Créé par</small>
                        <div class="fw-semibold">{{ $task->creator->full_name }}</div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Assigné à</small>
                        <div class="fw-semibold">{{ $task->assignedUser->full_name }}</div>
                    </div>
                    <div>
                        <small class="text-muted">Créé le</small>
                        <div class="fw-semibold">{{ $task->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Response Form -->
<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
    <div class="card-header bg-white border-bottom p-4">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-chat-square-text text-success me-2"></i>Votre Réponse
        </h5>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('tasks.respond.store', $task) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="response" class="form-label fw-bold text-dark">
                    <i class="bi bi-chat-left-text me-2"></i>Réponse
                </label>
                <textarea name="response" id="response" class="form-control" rows="6" 
                          placeholder="Décrivez comment vous avez accompli cette tâche..." required>{{ old('response') }}</textarea>
                @error('response')
                    <div class="text-danger small mt-1">
                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="file" class="form-label fw-bold text-dark">
                    <i class="bi bi-paperclip me-2"></i>Fichier joint (optionnel)
                </label>
                <input type="file" name="file" id="file" class="form-control" 
                       accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif">
                <div class="form-text text-muted">
                    Formats acceptés : PDF, Word, Excel, Images (Max 10MB)
                </div>
                @error('file')
                    <div class="text-danger small mt-1">
                        <i class="bi bi-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle-fill me-3"></i>
                <div>
                    <strong>Note importante :</strong> Lorsque vous soumettez votre réponse, la tâche sera automatiquement marquée comme "Terminée".
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-success btn-lg px-4 shadow-lg hover-scale">
                    <i class="bi bi-check-circle-fill me-2"></i>Soumettre la réponse
                </button>
                <a href="{{ route('tasks.show', $task) }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="bi bi-arrow-left me-2"></i>Retour à la tâche
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .response-header {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
</style>
@endsection
