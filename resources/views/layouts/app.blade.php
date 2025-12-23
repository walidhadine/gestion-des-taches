<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestion des Tâches')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #6366f1;
            --secondary-color: #10b981;
            --secondary-dark: #059669;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --dark-color: #1e293b;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --card-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        * {
            transition: all 0.2s ease;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #1e293b;
            min-height: 100vh;
        }
        
        .navbar-horizontal {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-horizontal .navbar-brand {
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            padding: 14px 20px;
        }
        
        .navbar-horizontal .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 14px 20px;
            margin: 4px 12px;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .navbar-horizontal .nav-link i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }
        
        .navbar-horizontal .nav-link:hover {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.3) 0%, rgba(99, 102, 241, 0.3) 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2);
        }
        
        .navbar-horizontal .nav-link.active {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }
        
        .main-content {
            padding: 30px;
            background: transparent;
        }
        
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
            overflow: hidden;
            background: white;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-2px);
        }
        
        .card-header {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            border-radius: 0;
            padding: 18px 24px;
            font-weight: 600;
            border: none;
        }
        
        .card-body {
            padding: 24px;
        }
        
        .btn {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.4);
            transform: translateY(-2px);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.3);
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            box-shadow: 0 6px 12px rgba(16, 185, 129, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            box-shadow: 0 4px 6px rgba(245, 158, 11, 0.3);
        }
        
        .badge-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-à-faire, .badge-todo { 
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
        }
        
        .badge-en-cours, .badge-progress { 
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }
        
        .badge-terminé, .badge-completed { 
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .badge-priority-faible { 
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
            color: white;
        }
        
        .badge-priority-moyenne { 
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }
        
        .badge-priority-élevée { 
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }
        
        .badge-priority-urgente { 
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 0.7rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.4);
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: var(--card-shadow);
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            color: #059669;
            border-left: 4px solid #10b981;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            color: #dc2626;
            border-left: 4px solid #ef4444;
        }
        
        .table {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
        }
        
        .table tbody tr:hover {
            background-color: #f8fafc;
            transform: scale(1.01);
        }
        
        h1, h2, h3, h4, h5, h6 {
            color: #1e293b;
            font-weight: 700;
        }
        
        .text-muted {
            color: #64748b !important;
        }
        
        #notification-bell {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.4);
            border: none;
        }
        
        #notification-bell:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 24px rgba(79, 70, 229, 0.5);
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    @auth
    <div class="container-fluid">
        <!-- Navigation Horizontale -->
        <nav class="navbar navbar-expand-lg navbar-horizontal">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <i class="bi bi-check2-square"></i> TaskManager
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index') }}">
                                <i class="bi bi-list-task"></i> Tâches
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}" href="{{ route('messages.index') }}">
                                <i class="bi bi-envelope"></i> Messages
                                <span class="notification-badge" id="message-count" style="display: none;">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}" href="{{ route('calendar.index') }}">
                                <i class="bi bi-calendar3"></i> Calendrier
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-shield-check"></i> Administration
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                                    <i class="bi bi-people"></i> Utilisateurs
                                </a></li>
                                <li><a class="dropdown-item {{ request()->routeIs('admin.statistics') ? 'active' : '' }}" href="{{ route('admin.statistics') }}">
                                    <i class="bi bi-graph-up"></i> Statistiques
                                </a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                    
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.show') }}">
                                    <i class="bi bi-person"></i> Profil
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item border-0 bg-transparent text-start">
                                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Notification Bell -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <button class="btn btn-primary rounded-circle" id="notification-bell" style="width: 50px; height: 50px;">
            <i class="bi bi-bell"></i>
            <span class="notification-badge" id="notification-count" style="display: none;">0</span>
        </button>
    </div>

    <!-- Notification Dropdown -->
    <div class="position-fixed bottom-0 end-0 p-3" id="notification-dropdown" style="display: none; z-index: 1051; max-width: 350px;">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Notifications</span>
                <button class="btn btn-sm btn-light" onclick="markAllAsRead()">Tout marquer lu</button>
            </div>
            <div class="card-body" id="notification-list" style="max-height: 400px; overflow-y: auto;">
                <!-- Notifications will be loaded here -->
            </div>
        </div>
    </div>
    @else
        @yield('content')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        // Notification system
        function loadNotifications() {
            $.get('{{ route("notifications.unread") }}', function(data) {
                $('#notification-count').text(data.length).toggle(data.length > 0);
                let html = '';
                if (data.length === 0) {
                    html = '<p class="text-muted text-center">Aucune notification</p>';
                } else {
                    data.forEach(function(notif) {
                        html += `
                            <div class="d-flex align-items-start mb-2 p-2 border-bottom">
                                <div class="flex-grow-1">
                                    <strong>${notif.titre}</strong>
                                    <p class="mb-0 small">${notif.contenu}</p>
                                    <small class="text-muted">${new Date(notif.created_at).toLocaleString('fr-FR')}</small>
                                </div>
                                <button class="btn btn-sm btn-link" onclick="markAsRead(${notif.id})">
                                    <i class="bi bi-check"></i>
                                </button>
                            </div>
                        `;
                    });
                }
                $('#notification-list').html(html);
            });
        }

        function markAsRead(id) {
            $.post(`/notifications/${id}/read`, {_token: '{{ csrf_token() }}'}, function() {
                loadNotifications();
                loadNotificationCount();
            });
        }

        function markAllAsRead() {
            $.post('{{ route("notifications.readAll") }}', {_token: '{{ csrf_token() }}'}, function() {
                loadNotifications();
                loadNotificationCount();
            });
        }

        function loadNotificationCount() {
            $.get('{{ route("notifications.count") }}', function(data) {
                $('#notification-count').text(data.count).toggle(data.count > 0);
            });
        }

        $('#notification-bell').click(function() {
            $('#notification-dropdown').toggle();
            loadNotifications();
        });

        // Load counts on page load
        @auth
        loadNotificationCount();
        setInterval(loadNotificationCount, 30000); // Every 30 seconds
        @endauth
    </script>
    @stack('scripts')
</body>
</html>

