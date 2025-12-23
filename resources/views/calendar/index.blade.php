@extends('layouts.app')

@section('title', 'Calendrier')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-calendar3"></i> Calendrier</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
        <i class="bi bi-plus-circle"></i> Nouvel Événement
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>

<!-- Modal pour créer/modifier un événement -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvel Événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="eventForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Date de début <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Date de fin <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="tache">Tâche</option>
                                <option value="reunion">Réunion</option>
                                <option value="personnel">Personnel</option>
                                <option value="projet">Projet</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="couleur" class="form-label">Couleur</label>
                            <input type="color" class="form-control form-control-color" id="couleur" name="couleur" value="#3498db">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lieu" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="lieu" name="lieu">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/fr.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '{{ route("calendar.events") }}',
        eventClick: function(info) {
            alert('Événement: ' + info.event.title);
        },
        dateClick: function(info) {
            document.getElementById('start_date').value = info.dateStr + 'T09:00';
            document.getElementById('end_date').value = info.dateStr + 'T10:00';
            new bootstrap.Modal(document.getElementById('eventModal')).show();
        }
    });
    calendar.render();

    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        fetch('{{ route("calendar.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                calendar.refetchEvents();
                bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide();
                this.reset();
            }
        });
    });
});
</script>
@endpush

