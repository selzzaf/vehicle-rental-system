@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow" style="background-color: #FFD1DC;">
                <div class="card-header text-center">
                    <h4 class="mb-0" style="font-family: 'Courier New', monospace; font-weight: bold; color: #8a0b79;">Editer votre profile</h4>
                </div>
            </div>
            
            <div class="card-body" style="background-color: #FDEEF4;">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label" style="font-family: 'Courier New', monospace; font-weight: bold; color: #8a0b79;">Nom</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $user->name) }}" required style="font-family: 'Courier New', monospace; font-weight: bold;">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-family: 'Courier New', monospace; font-weight: bold; color: #8a0b79;">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $user->email) }}" required style="font-family: 'Courier New', monospace; font-weight: bold;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr style="border-color: #8a0b79;">
                    <h6 style="font-family: 'Courier New', monospace; font-weight: bold; color: #8a0b79;">Changer mot de passe</h6>
                    <p class="text-muted small" style="font-family: 'Courier New', monospace; font-weight: bold; color: #8a0b79;">Laisser vide pour enregistrer mot de passe courant</p>

                    <div class="mb-3">
                        <label for="current_password" class="form-label" style="font-family: 'Courier New', monospace; font-weight: bold; color: #8a0b79;">Mot de passe courant</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" name="current_password" style="font-family: 'Courier New', monospace; font-weight: bold;">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label" style="font-family: 'Courier New', monospace; font-weight: bold; color: #8a0b79;">Nouveau mot de passe</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                               id="new_password" name="new_password" style="font-family: 'Courier New', monospace; font-weight: bold;">
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label" style="font-family: 'Courier New', monospace; font-weight: bold; color: #8a0b79;">Confirmer nouveau mot de passe</label>
                        <input type="password" class="form-control" 
                               id="new_password_confirmation" name="new_password_confirmation" style="font-family: 'Courier New', monospace; font-weight: bold;">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-dark" style="font-family: 'Courier New', monospace; font-weight: bold;">
                            Mettre à jour profile
                        </button>
                        
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-dark" style="font-family: 'Courier New', monospace; font-weight: bold;">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    body {
        background-color: #FFF0F5;
    }

    .btn-dark {
        background-color: #8B004B !important;
        border-color: #8B004B;
        color: #fff;
        font-weight: bold;
    }

    .btn-outline-dark {
        border-color: #8B004B;
        color: #8B004B;
        font-weight: bold;
    }

    .card-header {
        background-color: #8B004B;
        color: #fff;
    }

    .card-body {
        background-color: #FDEEF4;
    }

    .form-label {
        font-family: 'Courier New', monospace;
        font-weight: bold;
        color: #8a0b79;
    }

    .form-control {
        font-family: 'Courier New', monospace;
        font-weight: bold;
    }

    .invalid-feedback {
        font-family: 'Courier New', monospace;
        color: red;
        font-weight: bold;
    }
</style>
