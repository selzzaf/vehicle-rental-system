@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-12">
            <h1 class="text-center mb-4" style="color: #1a1a1a; font-family: 'Inter', sans-serif; font-weight: 700; font-size: 2.5rem;">
                <i class="fas fa-tachometer-alt me-3"></i>Tableau de Bord Admin
            </h1>
            <p class="text-center text-muted" style="font-family: 'Inter', sans-serif; font-size: 1.1rem;">
                Gérez votre plateforme de location de véhicules
            </p>
        </div>
    </div>

    <!-- Cartes de Gestion -->
    <div class="row g-4">
        <!-- Gestion des Utilisateurs -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-lg h-100 border-0" style="border-radius: 20px; transition: transform 0.3s ease;">
                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between" 
                     style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 20px 20px 0 0; border: none;">
                    <h6 class="m-0" style="font-weight: 600; color: white; font-family: 'Inter', sans-serif; font-size: 1.1rem;">
                        <i class="fas fa-users me-2"></i>Gestion des Utilisateurs
                    </h6>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light btn-sm" 
                       style="font-family: 'Inter', sans-serif; font-weight: 500; border-radius: 25px; padding: 8px 16px;">
                        Voir Tout
                    </a>
                </div>
                <div class="card-body p-4">
                    <p class="mb-4 text-center text-muted" style="font-family: 'Inter', sans-serif;">
                        Gérez les comptes utilisateurs et leurs permissions
                    </p>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-dark btn-block w-100" 
                       style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 12px; padding: 12px; transition: all 0.3s ease;">
                        <i class="fas fa-user-plus me-2"></i>Ajouter un Utilisateur
                    </a>
                </div>
            </div>
        </div>

        <!-- Gestion des Véhicules -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-lg h-100 border-0" style="border-radius: 20px; transition: transform 0.3s ease;">
                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between" 
                     style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 20px 20px 0 0; border: none;">
                    <h6 class="m-0" style="font-weight: 600; color: white; font-family: 'Inter', sans-serif; font-size: 1.1rem;">
                        <i class="fas fa-car me-2"></i>Gestion des Véhicules
                    </h6>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-light btn-sm" 
                       style="font-family: 'Inter', sans-serif; font-weight: 500; border-radius: 25px; padding: 8px 16px;">
                        Voir Tout
                    </a>
                </div>
                <div class="card-body p-4">
                    <p class="mb-4 text-center text-muted" style="font-family: 'Inter', sans-serif;">
                        Gérez votre flotte de véhicules disponibles
                    </p>
                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-dark btn-block w-100" 
                       style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 12px; padding: 12px; transition: all 0.3s ease;">
                        <i class="fas fa-car me-2"></i>Ajouter un Véhicule
                    </a>
                </div>
            </div>
        </div>

        <!-- Gestion des Réservations -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-lg h-100 border-0" style="border-radius: 20px; transition: transform 0.3s ease;">
                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between" 
                     style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 20px 20px 0 0; border: none;">
                    <h6 class="m-0" style="font-weight: 600; color: white; font-family: 'Inter', sans-serif; font-size: 1.1rem;">
                        <i class="fas fa-calendar-check me-2"></i>Gestion des Réservations
                    </h6>
                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-light btn-sm" 
                       style="font-family: 'Inter', sans-serif; font-weight: 500; border-radius: 25px; padding: 8px 16px;">
                        Voir Tout
                    </a>
                </div>
                <div class="card-body p-4">
                    <p class="mb-4 text-center text-muted" style="font-family: 'Inter', sans-serif;">
                        Suivi et gestion des réservations
                    </p>
                    <div class="row text-center g-2">
                        <div class="col-6">
                            <div class="bg-success text-white rounded-3 p-3" style="font-family: 'Inter', sans-serif; font-weight: 600;">
                                <div class="fs-4 fw-bold">{{ $activeReservations }}</div>
                                <small>Disponibles</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-dark text-white rounded-3 p-3" style="font-family: 'Inter', sans-serif; font-weight: 600;">
                                <div class="fs-4 fw-bold">{{ $reservedVehicles }}</div>
                                <small>Réservées</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Statistiques -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="card-header py-4" 
                     style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 20px 20px 0 0; border: none;">
                    <h5 class="m-0" style="font-weight: 600; color: white; font-family: 'Inter', sans-serif;">
                        <i class="fas fa-chart-bar me-2"></i>Statistiques Rapides
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-3 text-center">
                            <div class="p-4 rounded-3" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <i class="fas fa-users fa-2x text-dark mb-3"></i>
                                <h4 class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">{{ $activeReservations + $reservedVehicles }}</h4>
                                <p class="text-muted mb-0" style="font-family: 'Inter', sans-serif;">Total Utilisateurs</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-4 rounded-3" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <i class="fas fa-car fa-2x text-dark mb-3"></i>
                                <h4 class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">{{ $activeReservations + $reservedVehicles }}</h4>
                                <p class="text-muted mb-0" style="font-family: 'Inter', sans-serif;">Total Véhicules</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-4 rounded-3" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <i class="fas fa-calendar-check fa-2x text-dark mb-3"></i>
                                <h4 class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">{{ $reservedVehicles }}</h4>
                                <p class="text-muted mb-0" style="font-family: 'Inter', sans-serif;">Réservations Actives</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-4 rounded-3" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <i class="fas fa-percentage fa-2x text-dark mb-3"></i>
                                <h4 class="fw-bold text-dark" style="font-family: 'Inter', sans-serif;">
                                    {{ $activeReservations + $reservedVehicles > 0 ? round(($reservedVehicles / ($activeReservations + $reservedVehicles)) * 100) : 0 }}%
                                </h4>
                                <p class="text-muted mb-0" style="font-family: 'Inter', sans-serif;">Taux d'Occupation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
    }
    
    .rounded-3 {
        border-radius: 1rem !important;
    }
    
    .fs-4 {
        font-size: 1.5rem !important;
    }
    
    .fw-bold {
        font-weight: 700 !important;
    }
</style>
@endsection
