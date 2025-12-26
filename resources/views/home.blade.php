@extends('layouts.auth')

@section('title', 'TaskFlow - Gestion des Tâches Professionnelle')

@section('content')

<!-- Enhanced Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>
    
    <div class="container position-relative z-1">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                <h1 class="display-3 fw-bolder mb-4 text-white" style="letter-spacing: -1px;">
                    Flux de travail <span class="text-warning position-relative">
                        fluide
                        <svg class="position-absolute bottom-0 start-0 w-100 text-warning opacity-50" viewBox="0 0 100 10" preserveAspectRatio="none" style="height: 12px; z-index: -1;">
                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none" />
                        </svg>
                    </span> pour équipes modernes
                </h1>
                <p class="lead mb-5 text-white-50 mx-auto mx-lg-0" style="max-width: 500px;">
                    TaskFlow centralise vos projets, tâches et communications. 
                    Libérez le potentiel de votre équipe avec une interface intuitive et puissante.
                </p>
                <div class="d-flex justify-content-center justify-content-lg-start gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-5 py-3 fw-bold shadow-lg hover-lift text-dark">
                        <i class="bi bi-rocket-takeoff me-2"></i> Commencer maintenant
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-white btn-lg px-5 py-3 fw-bold border shadow-sm hover-lift text-dark bg-white">
                        <i class="bi bi-play-circle me-2"></i> Démo
                    </a>
                </div>
                <div class="mt-5 d-flex align-items-center justify-content-center justify-content-lg-start gap-4 text-white-50 small">
                    <div class="d-flex align-items-center"><i class="bi bi-check-circle-fill text-warning me-2"></i> Pas de carte requise</div>
                    <div class="d-flex align-items-center"><i class="bi bi-check-circle-fill text-warning me-2"></i> 14 jours gratuits</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <div class="position-absolute top-50 start-50 translate-middle bg-white rounded-circle opacity-10" style="width: 500px; height: 500px; filter: blur(80px);"></div>
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden position-relative hover-scale-sm transition-all" style="transform: perspective(1000px) rotateY(-5deg) rotateX(2deg);">
                        <div class="card-header bg-white border-bottom p-3 d-flex align-items-center gap-2">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></div>
                                <div class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></div>
                                <div class="rounded-circle bg-success" style="width: 10px; height: 10px;"></div>
                            </div>
                            <div class="mx-auto text-muted small fw-bold">TaskFlow Dashboard</div>
                        </div>
                        <div class="card-body p-0 bg-light">
                            <!-- Enhanced Mockup UI -->
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <div>
                                        <h5 class="fw-bold mb-1">Projet Lancement Web</h5>
                                        <div class="progress" style="height: 6px; width: 100px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex -space-x-2">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center border border-white" style="width: 32px; height: 32px; font-size: 12px;">JD</div>
                                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center border border-white ms-n2" style="width: 32px; height: 32px; font-size: 12px; margin-left: -10px;">AB</div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-4">
                                        <div class="bg-white p-3 rounded-3 shadow-sm border-start border-4 border-warning">
                                            <small class="text-muted d-block mb-1">À faire</small>
                                            <div class="fw-bold text-dark">Maquettes UX</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-white p-3 rounded-3 shadow-sm border-start border-4 border-primary">
                                            <small class="text-muted d-block mb-1">En cours</small>
                                            <div class="fw-bold text-dark">Intégration API</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-white p-3 rounded-3 shadow-sm border-start border-4 border-success">
                                            <small class="text-muted d-block mb-1">Terminé</small>
                                            <div class="fw-bold text-dark">Base de données</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Features Section -->
<div class="py-5 bg-white position-relative" id="features">
    <div class="container py-5">
        <div class="text-center mb-5 mx-auto" style="max-width: 700px;">
            <span class="text-primary fw-bold text-uppercase ls-1 small">Fonctionnalités</span>
            <h2 class="fw-bold text-dark mb-3 mt-2 display-6">Tout ce dont vous avez besoin</h2>
            <p class="text-muted fs-5">Une suite d'outils complète pour gérer vos projets de A à Z sans friction.</p>
        </div>
        
        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100 border border-transparent hover-border-primary transition-all group">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white text-primary mb-4 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-kanban fs-3"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Vue Kanban</h3>
                    <p class="text-muted mb-0">
                        Visualisez l'avancement de vos tâches en un coup d'œil. 
                        Glissez-déposez pour mettre à jour les statuts instantanément.
                    </p>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100 border border-transparent hover-border-primary transition-all group">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white text-success mb-4 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-chat-dots fs-3"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Chat Intégré</h3>
                    <p class="text-muted mb-0">
                        Communiquez en temps réel avec votre équipe. 
                        Discussions par projet ou messages directs pour une collaboration fluide.
                    </p>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100 border border-transparent hover-border-primary transition-all group">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white text-warning mb-4 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-pie-chart fs-3"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Analytiques</h3>
                    <p class="text-muted mb-0">
                        Suivez la productivité de votre équipe. 
                        Rapports détaillés sur les temps passés et les tâches complétées.
                    </p>
                </div>
            </div>
            
            <!-- Feature 4 -->
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100 border border-transparent hover-border-primary transition-all group">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white text-info mb-4 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-calendar3 fs-3"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Calendrier</h3>
                    <p class="text-muted mb-0">
                        Planifiez vos échéances et réunions. 
                        Synchronisation avec Google Calendar et Outlook.
                    </p>
                </div>
            </div>
            
            <!-- Feature 5 -->
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100 border border-transparent hover-border-primary transition-all group">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white text-danger mb-4 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-bell fs-3"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Notifications</h3>
                    <p class="text-muted mb-0">
                        Restez informé des mises à jour importantes. 
                        Notifications personnalisées et rappels automatiques.
                    </p>
                </div>
            </div>
            
            <!-- Feature 6 -->
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100 border border-transparent hover-border-primary transition-all group">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white text-secondary mb-4 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-shield-check fs-3"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Sécurité</h3>
                    <p class="text-muted mb-0">
                        Vos données sont protégées. 
                        Chiffrement de bout en bout et sauvegarde automatique.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Stats Section -->
<div class="py-5 bg-primary text-white position-relative overflow-hidden" id="stats">
    <div class="position-absolute top-0 end-0 opacity-10" style="transform: translate(30%, -30%);">
        <i class="bi bi-layers-fill" style="font-size: 400px;"></i>
    </div>
    <div class="container py-4 position-relative z-1">
        <div class="row text-center g-5">
            <div class="col-md-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white bg-opacity-10 mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-people-fill fs-2"></i>
                </div>
                <h3 class="display-4 fw-bold mb-0">10k+</h3>
                <p class="text-white-50 fw-medium mt-2">Utilisateurs actifs</p>
            </div>
            <div class="col-md-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white bg-opacity-10 mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-check-square-fill fs-2"></i>
                </div>
                <h3 class="display-4 fw-bold mb-0">1M+</h3>
                <p class="text-white-50 fw-medium mt-2">Tâches complétées</p>
            </div>
            <div class="col-md-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white bg-opacity-10 mb-3" style="width: 80px; height: 80px;">
                    <i class="bi bi-uptime fs-2"></i>
                </div>
                <h3 class="display-4 fw-bold mb-0">99.9%</h3>
                <p class="text-white-50 fw-medium mt-2">Disponibilité</p>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced CTA Section -->
<div class="py-5 text-center bg-white">
    <div class="container py-5">
        <div class="bg-dark rounded-5 p-5 position-relative overflow-hidden text-white shadow-lg mx-auto" style="max-width: 900px;">
            <div class="position-absolute top-0 start-0 w-100 h-100 opacity-20" style="background: radial-gradient(circle at 80% 20%, #3b82f6, transparent 40%);"></div>
            <div class="position-relative z-1">
                <h2 class="display-5 fw-bold mb-4">Prêt à transformer votre workflow ?</h2>
                <p class="lead mb-5 opacity-75 mx-auto" style="max-width: 600px;">
                    Rejoignez les milliers d'équipes qui utilisent TaskFlow pour livrer leurs projets plus rapidement.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-5 py-3 shadow hover-scale border-0 text-dark">
                        <i class="bi bi-rocket-takeoff me-2"></i> Créer un compte gratuit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Professional Footer -->
<footer class="bg-dark text-white py-5" id="contact">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-kanban me-2"></i>TaskFlow
                </h5>
                <p class="text-white-50">
                    La solution de gestion de tâches la plus moderne pour les équipes qui veulent exceller.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white-50 hover:text-white">
                        <i class="bi bi-twitter fs-5"></i>
                    </a>
                    <a href="#" class="text-white-50 hover:text-white">
                        <i class="bi bi-linkedin fs-5"></i>
                    </a>
                    <a href="#" class="text-white-50 hover:text-white">
                        <i class="bi bi-github fs-5"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-2">
                <h6 class="fw-bold mb-3">Produit</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#features" class="text-white-50 text-decoration-none hover:text-white">Fonctionnalités</a></li>
                    <li class="mb-2"><a href="#pricing" class="text-white-50 text-decoration-none hover:text-white">Tarifs</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover:text-white">Intégrations</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover:text-white">API</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2">
                <h6 class="fw-bold mb-3">Support</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover:text-white">Centre d'aide</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover:text-white">Documentation</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover:text-white">Contact</a></li>
                    <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover:text-white">Statut</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Newsletter</h6>
                <p class="text-white-50 mb-3">
                    Abonnez-vous pour recevoir les dernières mises à jour et fonctionnalités.
                </p>
                <div class="input-group">
                    <input type="email" class="form-control bg-dark border-secondary text-white" placeholder="votre@email.com">
                    <button class="btn btn-primary" type="button">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <hr class="border-secondary my-4">
        
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="text-white-50 small mb-0">
                    © 2024 TaskFlow. Tous droits réservés.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex gap-3 justify-content-md-end">
                    <a href="#" class="text-white-50 small text-decoration-none hover:text-white">Confidentialité</a>
                    <a href="#" class="text-white-50 small text-decoration-none hover:text-white">Conditions</a>
                    <a href="#" class="text-white-50 small text-decoration-none hover:text-white">Cookies</a>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .hover-lift:hover {
        transform: translateY(-5px);
    }
    .hover-scale:hover {
        transform: scale(1.02);
    }
    .hover-scale-sm:hover {
        transform: scale(1.02) !important;
    }
    .hover-border-primary:hover {
        border-color: var(--primary-color) !important;
        background-color: white !important;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.1);
    }
    .ls-1 {
        letter-spacing: 1px;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    
    /* Hero Section Animations */
    .hero-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    
    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: -1;
    }
    
    .shape {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        animation: float 6s ease-in-out infinite;
    }
    
    .shape-1 {
        width: 100px;
        height: 100px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .shape-2 {
        width: 150px;
        height: 150px;
        top: 60%;
        right: 10%;
        animation-delay: 2s;
    }
    
    .shape-3 {
        width: 80px;
        height: 80px;
        bottom: 20%;
        left: 30%;
        animation-delay: 4s;
    }
    
    .shape-4 {
        width: 120px;
        height: 120px;
        top: 30%;
        right: 25%;
        animation-delay: 1s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    /* Navbar animations */
    .navbar-brand:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    
    .nav-link {
        position: relative;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--primary-color);
        transition: width 0.3s ease;
    }
    
    .nav-link:hover::after {
        width: 100%;
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .hero-section .row {
            min-height: auto !important;
            padding: 4rem 0;
        }
        
        .display-3 {
            font-size: 2.5rem !important;
        }
        
        .display-5 {
            font-size: 1.8rem !important;
        }
    }
</style>
@endpush
@endsection
