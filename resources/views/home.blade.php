@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-5" style="color: #1a1a1a; font-family: 'Inter', sans-serif; font-weight: 700; font-size: 2.5rem;">
                <i class="fas fa-tachometer-alt me-3"></i>Tableau de bord
            </h1>

            <!-- Carte pour "Défiler" -->
            <div class="card mb-4 shadow-lg border-0" style="border-radius: 18px;">
                <div class="card-body p-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 18px;">
                    <h4 class="text-center mb-3" style="color: #1a1a1a; font-family: 'Inter', sans-serif; font-weight: 700;">
                        <i class="fas fa-car-side me-2"></i>Défiler
                    </h4>
                    <p class="text-center text-muted mb-4" style="font-family: 'Inter', sans-serif; font-size: 1.1rem;">Voir nos voitures libres</p>
                    <div class="text-center">
                        <a href="{{ route('vehicles.index') }}" class="btn btn-dark btn-lg px-5 py-2" 
                           style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 12px; transition: all 0.3s ease;">
                            <i class="fas fa-car me-2"></i>Voir voiture
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carte pour "Mes réservations" -->
            <div class="card mb-4 shadow-lg border-0" style="border-radius: 18px;">
                <div class="card-body p-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 18px;">
                    <h4 class="text-center mb-3" style="color: #1a1a1a; font-family: 'Inter', sans-serif; font-weight: 700;">
                        <i class="fas fa-calendar-check me-2"></i>Mes réservations
                    </h4>
                    <p class="text-center text-muted mb-4" style="font-family: 'Inter', sans-serif; font-size: 1.1rem;">Gestion de mes réservations</p>
                    <div class="text-center">
                        <a href="{{ route('reservations.index') }}" class="btn btn-dark btn-lg px-5 py-2" 
                           style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 12px; transition: all 0.3s ease;">
                            <i class="fas fa-calendar-alt me-2"></i>Voir réservations
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carte pour "Mon profil" -->
            <div class="card mb-4 shadow-lg border-0" style="border-radius: 18px;">
                <div class="card-body p-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 18px;">
                    <h4 class="text-center mb-3" style="color: #1a1a1a; font-family: 'Inter', sans-serif; font-weight: 700;">
                        <i class="fas fa-user-circle me-2"></i>Mon profil
                    </h4>
                    <p class="text-center text-muted mb-4" style="font-family: 'Inter', sans-serif; font-size: 1.1rem;">Mettre à jour mes informations</p>
                    <div class="text-center">
                        <a href="{{ route('profile.show') }}" class="btn btn-dark btn-lg px-5 py-2" 
                           style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 12px; transition: all 0.3s ease;">
                            <i class="fas fa-user-edit me-2"></i>Organiser profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-dark:hover {
        background: #000 !important;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
