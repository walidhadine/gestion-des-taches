<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TaskFlow')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #1d4ed8;
            --primary-light: #60a5fa;
            --secondary-color: #10b981;
            --secondary-dark: #059669;
            --accent-color: #8b5cf6;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #0ea5e9;
            --dark-color: #0f172a;
            --light-bg: #f8fafc;
            --sidebar-width: 280px;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            min-height: 100vh;
        }
        
        .navbar-horizontal {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            padding: 0.5rem 0;
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.03);
        }
        
        .navbar-horizontal .navbar-brand {
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.5px;
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-horizontal .navbar-brand:hover {
            background-color: rgba(59, 130, 246, 0.05);
            transform: translateY(-1px);
        }

        .navbar-horizontal .navbar-brand i {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.5rem;
        }
        
        .navbar-horizontal .nav-link {
            color: #64748b;
            padding: 8px 12px;
            margin: 0 2px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .navbar-horizontal .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .navbar-horizontal .nav-link:hover::before {
            left: 100%;
        }
        
        .navbar-horizontal .nav-link:hover, .navbar-horizontal .nav-link.active {
            color: var(--primary-color);
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(59, 130, 246, 0.15);
        }
        
        .navbar-horizontal .dropdown-menu {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -6px rgba(0, 0, 0, 0.04);
            padding: 8px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            margin-top: 8px;
            animation: dropdownFadeIn 0.3s ease;
        }
        
        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .navbar-horizontal .dropdown-item {
            border-radius: 8px;
            padding: 10px 16px;
            margin: 2px 0;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .navbar-horizontal .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            color: var(--primary-color);
            transform: translateX(4px);
        }
        
        .navbar-horizontal .dropdown-item.active {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
        }
        
        .navbar-horizontal .dropdown-item i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        
        .navbar-horizontal .dropdown-divider {
            margin: 8px 0;
            border-color: rgba(226, 232, 240, 0.6);
        }
        
        .navbar-horizontal .navbar-toggler {
            border: 2px solid var(--primary-color);
            border-radius: 8px;
            padding: 4px 8px;
            transition: all 0.3s ease;
        }
        
        .navbar-horizontal .navbar-toggler:hover {
            background-color: var(--primary-color);
            transform: scale(1.05);
        }
        
        .navbar-horizontal .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            background: white;
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 24px;
            font-weight: 700;
            color: var(--dark-color);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border: none;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            box-shadow: 0 6px 8px -1px rgba(59, 130, 246, 0.4);
            transform: translateY(-1px);
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
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }
        
        body {
            overflow-x: hidden;
        }
        
        .wrapper {
            overflow: visible;
        }
        
        .main-wrapper {
            overflow: visible;
        }
        
        .card,
        .main-content {
            position: relative;
            z-index: 1;
        }
        
        .position-absolute {
            z-index: 2;
        }
        
        /* Enhanced Headers de toutes les pages */
        .admin-dashboard-header,
        .dashboard-header,
        .calendar-header,
        .tasks-header,
        .users-header,
        .statistics-header,
        .stats-header {
            position: relative;
            z-index: 10;
        }
        
        /* Icônes décoratives dans tous les Enhanced Headers */
        .admin-dashboard-header .position-absolute,
        .dashboard-header .position-absolute,
        .calendar-header .position-absolute,
        .tasks-header .position-absolute,
        .users-header .position-absolute,
        .statistics-header .position-absolute,
        .stats-header .position-absolute {
            z-index: 11;
        }
        
        /* Conteneurs principaux de chaque page */
        [class*="-header"] {
            position: relative;
            z-index: 10;
        }
        
        /* Conteneurs z-1 dans les headers */
        .position-relative.z-1 {
            z-index: 12;
        }
        
        .navbar {
            overflow: visible !important;
        }
        
        .navbar-nav {
            overflow: visible !important;
        }
        
        .dropdown {
            overflow: visible !important;
        }
        
        .nav-item {
            position: relative;
            overflow: visible !important;
        }
        
        .main-content {
            padding: 20px;
        }
        
        /* Profile Dropdown Styles */
        .profile-dropdown-btn {
            padding: 8px 12px;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }
        
        .profile-dropdown-btn:hover {
            background: rgba(59, 130, 246, 0.05);
            transform: translateY(-1px);
        }
        
        .profile-dropdown-menu {
            position: absolute;
            z-index: 2000 !important;
            min-width: 320px;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 16px;
            padding: 16px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(226, 232, 240, 0.3);
            transition: opacity 0.18s ease, transform 0.18s ease;
            opacity: 0;
            transform: translateY(-6px);
        }

        .profile-dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .profile-item {
            border-radius: 12px;
            padding: 16px 20px;
            margin: 4px 0;
            transition: all 0.3s ease;
            border: 1px solid rgba(226, 232, 240, 0.3);
            background: rgba(255, 255, 255, 0.8);
            width: 100%;
            text-align: left;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .profile-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.05), transparent);
            transition: left 0.5s ease;
        }
        
        .profile-item:hover::before {
            left: 100%;
        }
        
        .profile-item:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
            transform: translateX(6px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.2);
        }
        
        .profile-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }
        
        .logout-item {
            border-color: rgba(239, 68, 68, 0.2);
        }
        
        .logout-item:hover {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(220, 38, 38, 0.08) 100%);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.3);
        }
        
        .dropdown-divider {
            margin: 16px 0;
            border-color: rgba(226, 232, 240, 0.8);
            border-width: 2px;
            opacity: 0.6;
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
            
            .navbar-horizontal .navbar-brand {
                font-size: 1.5rem;
            }
            
            .navbar-horizontal .nav-link {
                padding: 10px 16px;
                margin: 2px 0;
            }
            
            .navbar-horizontal .dropdown-menu {
                margin-top: 4px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <!-- Navigation Authentifiée -->
        <nav class="navbar navbar-expand-lg navbar-horizontal">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <i class="bi bi-check2-square"></i>
                    <span class="ms-2">TaskFlow</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="filter: invert(0.25);"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}" href="{{ route('calendar.index') }}">
                                <i class="bi bi-calendar3"></i> Calendrier
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}" href="{{ route('messages.index') }}">
                                <i class="bi bi-envelope"></i> Messages 
                                <span class="notification-badge" id="message-count" style="display: none;">0</span>
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.statistics') ? 'active' : '' }}" href="{{ route('admin.statistics') }}">
                                <i class="bi bi-graph-up"></i> Statistiques
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                                <i class="bi bi-people"></i> Utilisateurs
                            </a>
                        </li>
                        @endif
                    </ul>

                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-light position-relative d-flex align-items-center" id="notification-bell" style="width:44px;height:44px;border-radius:10px;">
                            <i class="bi bi-bell" style="font-size:1.1rem;color:var(--primary-dark);"></i>
                            <span class="notification-badge" id="notification-count" style="display:none;">0</span>
                        </button>

                        <div class="dropdown">
                            <button class="btn d-flex align-items-center text-decoration-none profile-dropdown-btn" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="position-relative">
                                    @if(auth()->user()->avatar_url)
                                        <img src="{{ auth()->user()->avatar_url }}" alt="avatar" width="40" height="40" class="rounded-circle border-2 border-white shadow-sm"/>
                                    @else
                                        <div class="rounded-circle border-2 border-white shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6, #8b5cf6); color: white; font-weight: 600; font-size: 14px;">
                                            {{ substr(auth()->user()->full_name, 0, 2) }}
                                        </div>
                                    @endif
                                    <div class="position-absolute bottom-0 end-0 bg-success rounded-circle" style="width: 12px; height: 12px; border: 2px solid white;"></div>
                                </div>
                                <div class="ms-3 d-none d-lg-block">
                                    <div class="fw-semibold text-dark small">{{ auth()->user()->full_name }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ auth()->user()->role == 'admin' ? 'Administrateur' : 'Utilisateur' }}</div>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end profile-dropdown-menu" aria-labelledby="profileDropdown">
                                <li>
                                    <a class="dropdown-item profile-item" href="{{ route('profile.show') }}">
                                        <div class="d-flex align-items-center">
                                            <div class="profile-icon bg-primary bg-opacity-10">
                                                <i class="bi bi-person text-primary"></i>
                                            </div>
                                            <div class="ms-3">
                                                <div class="fw-semibold">Mon Profil</div>
                                                <div class="text-muted small">Voir et modifier mes informations</div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">@csrf
                                        <button type="submit" class="dropdown-item profile-item logout-item">
                                            <div class="d-flex align-items-center">
                                                <div class="profile-icon bg-danger bg-opacity-10">
                                                    <i class="bi bi-box-arrow-right text-danger"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <div class="fw-semibold text-danger">Déconnexion</div>
                                                    <div class="text-muted small">Quitter ma session</div>
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
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
        loadNotificationCount();
        setInterval(loadNotificationCount, 30000); // Every 30 seconds
        
        // Improved profile dropdown: append menu to body and use Bootstrap+Popper fixed strategy
        (function() {
            const dropdownToggle = document.querySelector('.profile-dropdown-btn');
            const dropdownMenu = document.querySelector('.profile-dropdown-menu');

            if (!dropdownToggle || !dropdownMenu) return;

            // Append menu to body to avoid clipping/overflow issues
            if (!document.body.contains(dropdownMenu)) {
                document.body.appendChild(dropdownMenu);
            } else {
                document.body.appendChild(dropdownMenu);
            }

            // Initialize Bootstrap dropdown with Popper fixed strategy and bottom-end placement
            const profileDropdown = new bootstrap.Dropdown(dropdownToggle, {
                popperConfig: function(defaultBsPopperConfig) {
                    return Object.assign({}, defaultBsPopperConfig, {
                        placement: 'bottom-end',
                        strategy: 'fixed'
                    });
                }
            });

            // Toggle handled by Bootstrap; ensure clicks don't propagate and close correctly
            dropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.toggle();
            });

            document.addEventListener('click', function(e) {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>