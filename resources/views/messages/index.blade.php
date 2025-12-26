@extends('layouts.dashboard')

@section('title', 'Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-envelope"></i> Messages</h2>
    <a href="{{ route('messages.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouveau Message
    </a>
</div>

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link {{ $type == 'received' ? 'active' : '' }}" href="{{ route('messages.index', ['type' => 'received']) }}">
                    Reçus ({{ $unread_count }} non lus)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $type == 'sent' ? 'active' : '' }}" href="{{ route('messages.index', ['type' => 'sent']) }}">
                    Envoyés
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        @if($messages->count() > 0)
        <div class="list-group">
            @foreach($messages as $message)
            <a href="{{ route('messages.show', $message) }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        @if($type == 'received')
                        De: {{ $message->expediteur->full_name }}
                        @else
                        À: {{ $message->destinataire->full_name }}
                        @endif
                        @if(!$message->lu && $type == 'received')
                        <span class="badge bg-primary">Nouveau</span>
                        @endif
                    </h5>
                    <small>{{ $message->date_envoi->format('d/m/Y H:i') }}</small>
                </div>
                <p class="mb-1">
                    <strong>{{ $message->sujet ?: 'Sans sujet' }}</strong>
                </p>
                <p class="mb-1 text-muted">{{ Str::limit($message->message, 100) }}</p>
            </a>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $messages->links() }}
        </div>
        @else
        <p class="text-muted text-center">Aucun message.</p>
        @endif
    </div>
</div>
@endsection

