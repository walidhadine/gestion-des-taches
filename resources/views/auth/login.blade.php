@extends('layouts.login')

@section('title', 'Connexion - TaskFlow')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5 col-lg-4">
            <div class="text-center mb-4">
                <h4 class="fw-bold text-dark tracking-tight">Bon retour !</h4>
                <p class="text-muted">Connectez-vous à votre espace TaskFlow</p>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label text-muted small fw-bold text-uppercase">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control bg-light border-start-0 ps-0 @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
                            </div>
                            @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label text-muted small fw-bold text-uppercase">Mot de passe</label>
                                <!-- Optional: Add forgot password link here if route exists -->
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control bg-light border-start-0 ps-0 @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="••••••••" required>
                            </div>
                            @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label text-muted" for="remember">Se souvenir de moi</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3 shadow-sm hover-scale transition-all">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Se connecter
                        </button>
                    </form>
                </div>
                <div class="card-footer bg-light border-0 py-3 text-center">
                    <p class="mb-0 text-muted">
                        Pas encore de compte? 
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary">Créer un compte</a>
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-muted text-decoration-none small">
                    <i class="bi bi-arrow-left me-1"></i> Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Login Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-kanban me-2"></i>TaskFlow
                </h5>
                <p class="text-white-50 small">
                    La solution de gestion de tâches la plus moderne pour les équipes qui veulent exceller.
                </p>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-3 justify-content-md-end">
                    <a href="#" class="text-white-50 small text-decoration-none hover:text-white">Confidentialité</a>
                    <a href="#" class="text-white-50 small text-decoration-none hover:text-white">Conditions</a>
                    <a href="#" class="text-white-50 small text-decoration-none hover:text-white">Support</a>
                </div>
            </div>
        </div>
        <hr class="border-secondary my-3">
        <div class="text-center">
            <p class="text-white-50 small mb-0">
                © 2024 TaskFlow. Tous droits réservés.
            </p>
        </div>
    </div>
</footer>

<style>
    .hover-scale:hover {
        transform: translateY(-2px);
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-check-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.1);
    }
    .input-group-text {
        border-color: #dee2e6;
    }
    .form-control {
        border-color: #dee2e6;
    }
    .form-control:focus + .input-group-text, .form-control:focus {
        border-color: var(--primary-color);
    }
</style>
@endsection

