@extends('layouts.dashboard')

@section('title', 'Message')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-envelope"></i> Message</h2>
    <a href="{{ route('messages.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">{{ $message->sujet ?: 'Sans sujet' }}</h5>
                <small>
                    De: {{ $message->expediteur->full_name }} | 
                    À: {{ $message->destinataire->full_name }} | 
                    {{ $message->date_envoi->format('d/m/Y à H:i') }}
                </small>
            </div>
            <div>
                @if($message->task)
                <a href="{{ route('tasks.show', $message->task) }}" class="btn btn-sm btn-info">
                    <i class="bi bi-list-task"></i> Voir la tâche
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <p>{{ $message->message }}</p>
    </div>
</div>
@endsection

