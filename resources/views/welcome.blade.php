@extends('layouts.auth')

@section('title', 'Bienvenue - TaskFlow')

@section('content')
<!-- Hero Section -->
<div class="position-relative overflow-hidden text-center text-white" 
     style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); padding-top: 100px; padding-bottom: 100px;">
    <div class="container position-relative z-1">
        <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-10 rounded-pill px-3 py-1 mb-4 border border-white border-opacity-25">
            <span class="text-white small fw-bold"><i class="bi bi-stars me-2"></i>La nouvelle référence de productivité</span>
        </div>
        <h1 class="display-3 fw-bold mb-4" style="letter-spacing: -1px;">Gérez vos tâches avec <span class="text-warning">excellence</span></h1>
        <p class="lead mb-5 opacity-90 mx-auto fw-light" style="max-width: 700px; font-size: 1.25rem;">
            TaskFlow est la solution professionnelle pour organiser, collaborer et réussir vos projets. 
            Simple, efficace et conçu pour les équipes modernes.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3 fw-bold text-primary shadow-lg hover-scale">
                <i class="bi bi-rocket-takeoff me-2"></i>Commencer gratuitement
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold hover-scale">
                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
            </a>
        </div>
    </div>
    
    <!-- Abstract Shapes/Background Decoration -->
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="opacity: 0.1;">
        <div class="position-absolute top-0 start-50 translate-middle rounded-circle bg-white" style="width: 800px; height: 800px; filter: blur(80px);"></div>
        <div class="position-absolute bottom-0 end-0 translate-middle rounded-circle bg-white" style="width: 600px; height: 600px; filter: blur(60px);"></div>
    </div>
</div>

<!-- Features Section -->
<div class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark mb-3">Pourquoi choisir TaskFlow ?</h2>
            <p class="text-muted fs-5">Des outils puissants pour booster votre productivité au quotidien</p>
        </div>
        
        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4 rounded-4">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary mb-4 shadow-sm" style="width: 70px; height: 70px;">
                            <i class="bi bi-kanban fs-2"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3 text-dark">Organisation Intuitive</h3>
                        <p class="text-muted mb-0">
                            Créez, assignez et suivez vos tâches facilement grâce à une interface claire. 
                            Gérez vos priorités et ne manquez plus aucune échéance.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4 rounded-4">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success bg-opacity-10 text-success mb-4 shadow-sm" style="width: 70px; height: 70px;">
                            <i class="bi bi-people fs-2"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3 text-dark">Collaboration Temps Réel</h3>
                        <p class="text-muted mb-0">
                            Travaillez en équipe sans friction. Partagez des fichiers, commentez les tâches 
                            et restez synchronisé avec vos collègues instantanément.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center p-4 rounded-4">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-warning bg-opacity-10 text-warning mb-4 shadow-sm" style="width: 70px; height: 70px;">
                            <i class="bi bi-graph-up-arrow fs-2"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3 text-dark">Suivi et Statistiques</h3>
                        <p class="text-muted mb-0">
                            Visualisez votre progression avec des tableaux de bord détaillés. 
                            Analysez votre productivité et optimisez votre flux de travail.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-scale:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
</style>
@endsection

<!-- Stats/Trust Section -->
<div class="py-5" style="background-color: #f8fafc;">
    <div class="container py-4">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <h3 class="display-4 fw-bold text-primary">100%</h3>
                <p class="text-muted fw-bold text-uppercase ls-1">Sécurisé</p>
            </div>
            <div class="col-md-4">
                <h3 class="display-4 fw-bold text-primary">24/7</h3>
                <p class="text-muted fw-bold text-uppercase ls-1">Accessible</p>
            </div>
            <div class="col-md-4">
                <h3 class="display-4 fw-bold text-primary">Simple</h3>
                <p class="text-muted fw-bold text-uppercase ls-1">Prise en main</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="py-5 text-center bg-white">
    <div class="container py-5">
        <h2 class="display-6 fw-bold mb-4">Prêt à transformer votre façon de travailler ?</h2>
        <p class="lead mb-5 text-muted mx-auto" style="max-width: 600px;">
            Rejoignez TaskManager aujourd'hui et découvrez une nouvelle manière de gérer vos projets.
        </p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3 shadow hover-scale">
            Créer un compte maintenant
        </a>
    </div>
</div>

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }
    .hover-scale {
        transition: transform 0.2s ease;
    }
    .hover-scale:hover {
        transform: scale(1.05);
    }
    .ls-1 {
        letter-spacing: 1px;
    }
</style>
@endpush
@endsection
