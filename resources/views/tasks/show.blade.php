@extends('layouts.app')

@section('title', $task->titre)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-list-task"></i> {{ $task->titre }}</h2>
    <div>
        @can('update', $task)
        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        @endcan
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Détails de la Tâche</h5>
            </div>
            <div class="card-body">
                <p><strong>Description:</strong></p>
                <p>{{ $task->description ?: 'Aucune description' }}</p>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><strong>Statut:</strong> 
                            <span class="badge badge-status badge-{{ str_replace(' ', '-', $task->status) }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </p>
                        <p><strong>Priorité:</strong> 
                            <span class="badge badge-priority-{{ $task->priority }}">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </p>
                        <p><strong>Progression:</strong> {{ $task->completion_percentage }}%</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Date de début:</strong> {{ $task->date_debut ? $task->date_debut->format('d/m/Y') : '-' }}</p>
                        <p><strong>Date de fin:</strong> {{ $task->date_fin ? $task->date_fin->format('d/m/Y') : '-' }}</p>
                        @if($task->category)
                        <p><strong>Catégorie:</strong> 
                            <span class="badge" style="background-color: {{ $task->category->color }}">
                                {{ $task->category->nom }}
                            </span>
                        </p>
                        @endif
                    </div>
                </div>

                @if($task->notes)
                <div class="mt-3">
                    <p><strong>Notes:</strong></p>
                    <p>{{ $task->notes }}</p>
                </div>
                @endif

                @if($task->fichier_joint)
                <div class="mt-3">
                    <p><strong>Fichier joint:</strong></p>
                    <a href="{{ asset('storage/' . $task->fichier_joint) }}" target="_blank" class="btn btn-sm btn-primary">
                        <i class="bi bi-download"></i> Télécharger
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Commentaires -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Commentaires et Réponses</h5>
            </div>
            <div class="card-body">
                @foreach($task->comments as $comment)
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $comment->user->full_name }}</strong>
                        <small class="text-muted">{{ $comment->date_comment->format('d/m/Y H:i') }}</small>
                    </div>
                    <p class="mt-2">{{ $comment->comment }}</p>
                    @if($comment->fichier_joint)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $comment->fichier_joint) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-paperclip"></i> Fichier joint
                        </a>
                    </div>
                    @endif
                </div>
                @endforeach

                @if($task->comments->isEmpty())
                <p class="text-muted text-center py-3">Aucun commentaire pour le moment.</p>
                @endif

                <!-- Formulaire de réponse -->
                @if($task->assigned_to == Auth::id() || $task->created_by == Auth::id())
                <div class="mt-4 pt-3 border-top">
                    <h6 class="mb-3">Répondre à cette tâche</h6>
                    <form method="POST" action="{{ route('tasks.comment', $task) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="comment" class="form-label">Votre réponse <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" 
                                      id="comment" name="comment" rows="4" 
                                      placeholder="Ajoutez votre réponse ou commentaire..." required>{{ old('comment') }}</textarea>
                            @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> 
                                En répondant, la tâche sera automatiquement marquée comme "terminée".
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="fichier_joint" class="form-label">Fichier joint (optionnel)</label>
                            <input type="file" class="form-control @error('fichier_joint') is-invalid @enderror" 
                                   id="fichier_joint" name="fichier_joint">
                            @error('fichier_joint')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Envoyer la réponse
                        </button>
                    </form>
                </div>
                @else
                <div class="alert alert-info mt-3">
                    <i class="bi bi-info-circle"></i> 
                    Seuls l'assigné et le créateur de la tâche peuvent répondre.
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informations</h5>
            </div>
            <div class="card-body">
                <p><strong>Créé par:</strong> {{ $task->creator->full_name }}</p>
                <p><strong>Assigné à:</strong> {{ $task->assignedUser->full_name }}</p>
                <p><strong>Date de création:</strong> {{ $task->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Dernière modification:</strong> {{ $task->date_modification->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Historique -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Historique</h5>
            </div>
            <div class="card-body">
                @foreach($task->history->take(5) as $history)
                <div class="small mb-2">
                    <strong>{{ $history->user->full_name }}</strong> - {{ $history->action }}
                    <br>
                    <small class="text-muted">{{ $history->date_action->format('d/m/Y H:i') }}</small>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

