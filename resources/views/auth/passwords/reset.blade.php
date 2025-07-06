@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="text-center mb-4">
                <h2 class="section-title">Réinitialiser le mot de passe</h2>
                <p class="text-muted">Choisissez un nouveau mot de passe sécurisé</p>
            </div>
            
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-dark">
                                <i class="fas fa-envelope me-2"></i>Adresse email
                            </label>
                            <input id="email" type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" value="{{ $email ?? old('email') }}" 
                                   required autocomplete="email" autofocus
                                   placeholder="votre@email.com">

                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-dark">
                                <i class="fas fa-lock me-2"></i>Nouveau mot de passe
                            </label>
                            <input id="password" type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password"
                                   placeholder="Minimum 8 caractères">

                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold text-dark">
                                <i class="fas fa-lock me-2"></i>Confirmer le mot de passe
                            </label>
                            <input id="password-confirm" type="password" 
                                   class="form-control form-control-lg" 
                                   name="password_confirmation" 
                                   required autocomplete="new-password"
                                   placeholder="Confirmez votre mot de passe">
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-dark btn-lg">
                                <i class="fas fa-key me-2"></i>
                                Réinitialiser le mot de passe
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none text-muted">
                                <i class="fas fa-arrow-left me-1"></i>
                                Retour à la connexion
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #1f2937;
    box-shadow: 0 0 0 0.2rem rgba(31, 41, 55, 0.25);
}

.btn-dark {
    background: linear-gradient(135deg, #1f2937, #374151);
    border: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-dark:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(31, 41, 55, 0.3);
}
</style>
@endsection
