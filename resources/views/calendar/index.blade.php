@extends('layouts.dashboard')

@section('title', 'Calendrier - TaskFlow')

@section('content')
<!-- Enhanced Calendar Header -->
<div class="calendar-header position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 20px; padding: 2rem;">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(20%, -20%);">
        <i class="bi bi-calendar3" style="font-size: 200px;"></i>
    </div>
    <div class="position-relative z-1">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-white">
                <h1 class="display-5 fw-bold mb-2">
                    <i class="bi bi-calendar3 me-3"></i>Calendrier
                </h1>
                <p class="text-white-50 mb-0 fs-5">
                    <i class="bi bi-clock-history me-2"></i>Gérez vos événements et planifiez votre temps
                </p>
            </div>
            <div class="d-flex gap-3">
                <button class="btn btn-warning btn-lg px-4 shadow-lg hover-scale" data-bs-toggle="modal" data-bs-target="#eventModal">
                    <i class="bi bi-plus-circle-fill me-2"></i> Nouvel Événement
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Calendar Container -->
<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
    <div class="card-header bg-white border-bottom p-4">
        <h5 class="mb-0 fw-bold text-dark">
            <i class="bi bi-calendar-week text-warning me-2"></i>Vue du Calendrier
        </h5>
    </div>
    <div class="card-body p-4">
        <div id="calendar"></div>
    </div>
</div>

<!-- Enhanced Event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-warning bg-gradient text-white border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-calendar-plus me-2"></i>Nouvel Événement
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="eventForm">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="titre" class="form-label fw-bold text-muted small text-uppercase">Titre de l'événement <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-type text-warning"></i>
                                </span>
                                <input type="text" class="form-control bg-light border-start-0 ps-0" id="titre" name="titre" required placeholder="Entrez le titre de l'événement">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bold text-muted small text-uppercase">Description</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 align-items-start" style="padding-top: 12px;">
                                    <i class="bi bi-text-paragraph text-warning"></i>
                                </span>
                                <textarea class="form-control bg-light border-start-0 ps-0" id="description" name="description" rows="3" placeholder="Ajoutez une description détaillée"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="start_date" class="form-label fw-bold text-muted small text-uppercase">Date de début <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-calendar-event text-warning"></i>
                                </span>
                                <input type="datetime-local" class="form-control bg-light border-start-0 ps-0" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label fw-bold text-muted small text-uppercase">Date de fin <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-calendar-check text-warning"></i>
                                </span>
                                <input type="datetime-local" class="form-control bg-light border-start-0 ps-0" id="end_date" name="end_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label fw-bold text-muted small text-uppercase">Type <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-tag text-warning"></i>
                                </span>
                                <select class="form-select bg-light border-start-0 ps-0" id="type" name="type" required>
                                    <option value="tache">Tâche</option>
                                    <option value="reunion">Réunion</option>
                                    <option value="personnel">Personnel</option>
                                    <option value="projet">Projet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="couleur" class="form-label fw-bold text-muted small text-uppercase">Couleur</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-palette text-warning"></i>
                                </span>
                                <input type="color" class="form-control bg-light border-start-0 ps-0" id="couleur" name="couleur" value="#f59e0b">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="lieu" class="form-label fw-bold text-muted small text-uppercase">Lieu</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-geo-alt text-warning"></i>
                                </span>
                                <input type="text" class="form-control bg-light border-start-0 ps-0" id="lieu" name="lieu" placeholder="Entrez le lieu de l'événement">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 p-4">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-2"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-warning px-4">
                        <i class="bi bi-check-circle me-2"></i>Créer l'événement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
    .calendar-header {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
    }
    #calendar {
        min-height: 600px;
    }
    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
    }
    .fc-button {
        background: #f59e0b !important;
        border-color: #f59e0b !important;
        color: white !important;
    }
    .fc-button:hover {
        background: #d97706 !important;
        border-color: #d97706 !important;
    }
    .fc-button-active {
        background: #d97706 !important;
        border-color: #d97706 !important;
    }
</style>
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
        events: function(fetchInfo, successCallback, failureCallback) {
            // Charger les tâches depuis l'API
            fetch('{{ route("tasks.index") }}?ajax=1', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const events = [];
                
                if (data.tasks && data.tasks.length > 0) {
                    data.tasks.forEach(function(task) {
                        // Créer un événement pour chaque tâche avec sa durée
                        if (task.date_debut && task.date_fin) {
                            const startDate = new Date(task.date_debut);
                            const endDate = new Date(task.date_fin);
                            
                            // Déterminer la couleur selon le statut
                            let color = '#6c757d'; // gris par défaut
                            if (task.status === 'à faire') color = '#f59e0b'; // orange
                            else if (task.status === 'en cours') color = '#3b82f6'; // bleu
                            else if (task.status === 'terminé') color = '#10b981'; // vert
                            
                            events.push({
                                id: 'task-' + task.id,
                                title: task.titre,
                                start: startDate.toISOString().split('T')[0],
                                end: new Date(endDate.getTime() + 24 * 60 * 60 * 1000).toISOString().split('T')[0], // Inclure le jour de fin
                                backgroundColor: color,
                                borderColor: color,
                                textColor: '#ffffff',
                                extendedProps: {
                                    description: task.description || '',
                                    status: task.status,
                                    priority: task.priority,
                                    assignedTo: task.assignedUser ? task.assignedUser.full_name : 'Non assigné',
                                    taskId: task.id
                                }
                            });
                        }
                    });
                }
                
                successCallback(events);
            })
            .catch(error => {
                console.error('Erreur lors du chargement des tâches:', error);
                failureCallback(error);
            });
        },
        eventClick: function(info) {
            const task = info.event.extendedProps;
            const content = `
                <div style="max-width: 400px;">
                    <h6 style="margin-bottom: 15px; color: #333;">${info.event.title}</h6>
                    <p style="margin-bottom: 8px; color: #666;"><strong>Description:</strong> ${task.description || 'Aucune description'}</p>
                    <p style="margin-bottom: 8px; color: #666;"><strong>Statut:</strong> <span class="badge" style="background-color: ${info.event.backgroundColor}; color: white;">${task.status}</span></p>
                    <p style="margin-bottom: 8px; color: #666;"><strong>Assigné à:</strong> ${task.assignedTo}</p>
                    ${task.priority ? `<p style="margin-bottom: 8px; color: #666;"><strong>Priorité:</strong> ${task.priority}</p>` : ''}
                    <p style="margin-bottom: 8px; color: #666;"><strong>Durée:</strong> ${info.event.start.toLocaleDateString('fr-FR')} - ${new Date(info.event.end.getTime() - 24 * 60 * 60 * 1000).toLocaleDateString('fr-FR')}</p>
                    <div style="margin-top: 15px;">
                        <a href="/tasks/${task.taskId}" class="btn btn-primary btn-sm" style="margin-right: 10px;">Voir la tâche</a>
                        <button class="btn btn-secondary btn-sm" onclick="bootstrap.Modal.getInstance(document.querySelector('.modal')).hide();">Fermer</button>
                    </div>
                </div>
            `;
            
            // Créer un modal dynamique pour afficher les détails
            const modalHtml = `
                <div class="modal fade" id="taskDetailModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Détails de la tâche</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                ${content}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Supprimer le modal existant s'il y en a un
            const existingModal = document.getElementById('taskDetailModal');
            if (existingModal) {
                existingModal.remove();
            }
            
            // Ajouter et afficher le nouveau modal
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            const modal = new bootstrap.Modal(document.getElementById('taskDetailModal'));
            modal.show();
        },
        dateClick: function(info) {
            document.getElementById('start_date').value = info.dateStr + 'T09:00';
            document.getElementById('end_date').value = info.dateStr + 'T10:00';
            new bootstrap.Modal(document.getElementById('eventModal')).show();
        },
        eventDidMount: function(info) {
            // Ajouter un tooltip avec plus d'informations
            const task = info.event.extendedProps;
            const tooltipContent = `
                <strong>${info.event.title}</strong><br>
                ${task.description ? task.description.substring(0, 50) + '...' : 'Aucune description'}<br>
                Statut: ${task.status}<br>
                Assigné: ${task.assignedTo}
            `;
            
            info.el.setAttribute('title', tooltipContent.replace(/<[^>]*>/g, '\n'));
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

