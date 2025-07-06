@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section-title">Détails du Véhicule</h2>
                <a href="{{ route('vehicles.index') }}" class="btn btn-outline-dark">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux véhicules
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Vehicle Image -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body p-0">
                    @if($vehicle->image_path)
                        <img src="{{ asset('pictures/' . $vehicle->image_path) }}" 
                             alt="{{ $vehicle->marque }} {{ $vehicle->model }}" 
                             class="img-fluid w-100" style="height: 400px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="height: 400px;">
                            <i class="fas fa-car fa-6x text-muted"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Vehicle Description -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h1 class="mb-0 fw-bold" style="font-family: 'Inter', sans-serif;">{{ $vehicle->marque }} {{ $vehicle->model }}</h1>
                        <span class="badge 
                            @if($vehicle->status === 'available') bg-success 
                            @else bg-secondary 
                            @endif
                            fs-6 px-3 py-2"
                            style="font-family: 'Inter', sans-serif; letter-spacing: 0.5px;">
                            {{ $vehicle->status === 'available' ? 'Disponible' : 'Maintenance' }}
                        </span>
                    </div>
                    <p class="text-muted mb-4">{{ $vehicle->description }}</p>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-id-card text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Plaque d'immatriculation</small>
                                    <strong>{{ $vehicle->license_plate }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-tag text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Prix journalier</small>
                                    <strong class="text-primary">{{ number_format($vehicle->prix, 0) }} DH</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Vehicle Status Card -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Statut du Véhicule</h5>
                        @if($vehicle->status === 'available' && auth()->check() && !auth()->user()->is_admin)
                            <div class="d-grid">
                                <a href="{{ route('reservations.create', ['vehicle_id' => $vehicle->id]) }}" 
                                   class="btn btn-dark btn-lg">
                                    <i class="fas fa-calendar-check me-2"></i>Réserver ce véhicule
                                </a>
                            </div>
                        @elseif($vehicle->status === 'reserved')
                            <div class="alert alert-warning">
                                <i class="fas fa-clock me-2"></i>
                                Ce véhicule est actuellement réservé
                            </div>
                        @elseif($vehicle->status === 'maintenance')
                            <div class="alert alert-danger">
                                <i class="fas fa-tools me-2"></i>
                                Ce véhicule est en maintenance
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Vehicle Specifications -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Spécifications</h5>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Marque</span>
                                <strong>{{ $vehicle->marque }}</strong>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Modèle</span>
                                <strong>{{ $vehicle->model }}</strong>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted">Prix/jour</span>
                                <strong class="text-primary">{{ number_format($vehicle->prix, 0) }} DH</strong>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <span class="text-muted">Plaque</span>
                                <strong>{{ $vehicle->license_plate }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.status-badge {
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 1rem;
    font-weight: 600;
    min-width: 110px;
    text-align: center;
}

.status-available {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.status-reserved {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.status-maintenance {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
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

.btn-outline-dark {
    border: 2px solid #1f2937;
    color: #1f2937;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-dark:hover {
    background: #1f2937;
    color: white;
    transform: translateY(-2px);
}

.status-badge-fix {
    display: block;
    margin-top: 0.5rem;
    margin-left: 0;
}
</style>
@endsection 