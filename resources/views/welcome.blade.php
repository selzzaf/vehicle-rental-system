@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Location de Véhicules <span class="text-warning">Premium</span>
                </h1>
                <p class="lead mb-4">
                    Découvrez notre flotte de véhicules modernes et confortables. 
                    Location simple, rapide et sécurisée pour tous vos déplacements.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('vehicles.index') }}" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-car me-2"></i>Voir nos véhicules
                    </a>
                    <a href="{{ route('reservations.create') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-car-side fa-8x text-warning opacity-75"></i>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-shield-alt fa-2x text-primary"></i>
                    </div>
                    <h5 class="card-title fw-bold">Sécurité Garantie</h5>
                    <p class="card-text text-muted">
                        Tous nos véhicules sont assurés et entretenus régulièrement pour votre sécurité.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-clock fa-2x text-success"></i>
                    </div>
                    <h5 class="card-title fw-bold">Disponible 24/7</h5>
                    <p class="card-text text-muted">
                        Service client disponible 24h/24 et 7j/7 pour répondre à tous vos besoins.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-tags fa-2x text-warning"></i>
                    </div>
                    <h5 class="card-title fw-bold">Prix Compétitifs</h5>
                    <p class="card-text text-muted">
                        Tarifs transparents et compétitifs sans frais cachés.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Vehicles Section -->
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="section-title">Nos Véhicules en Vedette</h2>
        <p class="text-muted lead">Découvrez notre sélection de véhicules les plus populaires</p>
    </div>
    
    <div class="row g-4">
        @forelse($vehicles->take(6) as $vehicle)
            <div class="col-lg-4 col-md-6">
                <div class="card vehicle-card h-100">
                    @if($vehicle->image_path)
                        <img src="{{ asset('pictures/' . $vehicle->image_path) }}" 
                             class="card-img-top" 
                             alt="{{ $vehicle->marque }} {{ $vehicle->model }}">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 280px;">
                            <i class="fas fa-car fa-4x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="price-tag">
                        {{ number_format($vehicle->prix, 0) }} DH/jour
                    </div>
                    
                    <div class="status-badge {{ $vehicle->status === 'available' ? 'status-available' : ($vehicle->status === 'reserved' ? 'status-reserved' : 'status-maintenance') }}">
                        {{ $vehicle->status === 'available' ? 'Disponible' : ($vehicle->status === 'reserved' ? 'Réservé' : 'Maintenance') }}
                    </div>
                    
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-2">{{ $vehicle->marque }} {{ $vehicle->model }}</h5>
                        <p class="card-text text-muted mb-3">{{ Str::limit($vehicle->description, 100) }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="vehicle-info">
                                <small class="text-muted">
                                    <i class="fas fa-id-card me-1"></i>{{ $vehicle->license_plate }}
                                </small>
                            </div>
                            <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="py-5">
                    <i class="fas fa-car fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun véhicule disponible pour le moment</h4>
                    <p class="text-muted">Revenez bientôt pour découvrir nos nouvelles offres !</p>
                </div>
            </div>
        @endforelse
    </div>
    
    @if($vehicles->count() > 6)
        <div class="text-center mt-4">
            <a href="{{ route('vehicles.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-list me-2"></i>Voir tous nos véhicules
            </a>
        </div>
    @endif
</div>

<!-- CTA Section -->
<div class="container my-5">
    <div class="card border-0" style="background: linear-gradient(135deg, var(--success-color), var(--primary-color));">
        <div class="card-body text-center text-white p-5">
            <h3 class="fw-bold mb-3">Prêt à partir ?</h3>
            <p class="lead mb-4">Réservez votre véhicule en quelques clics et profitez de votre voyage !</p>
            <a href="{{ route('reservations.create') }}" class="btn btn-light btn-lg px-4">
                <i class="fas fa-rocket me-2"></i>Commencer ma réservation
            </a>
        </div>
    </div>
</div>
@endsection
