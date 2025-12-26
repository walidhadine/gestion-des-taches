@extends('layouts.dashboard')

@section('title', 'Notifications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-bell"></i> Notifications</h2>
    <form method="POST" action="{{ route('notifications.readAll') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-all"></i> Tout marquer comme lu
        </button>
    </form>
</div>

<div class="card">
    <div class="card-body">
        @if($notifications->count() > 0)
        <div class="list-group">
            @foreach($notifications as $notification)
            <div class="list-group-item {{ !$notification->vue ? 'bg-light' : '' }}">
                <div class="d-flex w-100 justify-content-between">
                    <div class="flex-grow-1">
                        <h5 class="mb-1">
                            {{ $notification->titre }}
                            @if(!$notification->vue)
                            <span class="badge bg-primary">Nouveau</span>
                            @endif
                        </h5>
                        <p class="mb-1">{{ $notification->contenu }}</p>
                        <small class="text-muted">{{ $notification->created_at->format('d/m/Y à H:i') }}</small>
                    </div>
                    <div>
                        @if($notification->lien)
                        <a href="{{ $notification->lien }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        @endif
                        @if(!$notification->vue)
                        <form method="POST" action="{{ route('notifications.read', $notification) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="bi bi-check"></i>
                            </button>
                        </form>
                        @endif
                        <form method="POST" action="{{ route('notifications.destroy', $notification) }}" class="d-inline" 
                              onsubmit="return confirm('Supprimer cette notification?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $notifications->links() }}
        </div>
        @else
        <p class="text-muted text-center">Aucune notification.</p>
        @endif
    </div>
</div>
@endsection

