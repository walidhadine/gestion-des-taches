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
        
        h1, h2, h3, h4, h5, h6 {
            color: #1e293b;
            font-weight: 700;
        }
        
        .text-muted {
            color: #64748b !important;
        }
        
        @media (max-width: 768px) {
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
    <!-- Guest Navigation -->
    <nav class="navbar navbar-expand-lg navbar-horizontal">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-check2-square"></i>
                <span class="ms-2">TaskFlow</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#guestNavbar" aria-controls="guestNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(0.25);"></span>
            </button>

            <div class="collapse navbar-collapse" id="guestNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#features">Fonctionnalités</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Avantages</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="navbar-nav ms-auto">
                    <div class="d-flex align-items-center gap-2">
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">Se connecter</a>
                        <a class="btn btn-primary" href="{{ route('register') }}">S'inscrire</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    @stack('scripts')
</body>
</html>
