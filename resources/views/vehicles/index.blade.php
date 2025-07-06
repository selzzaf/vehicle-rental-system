@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="section-title">Notre Flotte de Véhicules</h1>
        <p class="text-muted lead">Découvrez notre sélection de véhicules modernes et confortables</p>
    </div>

    <!-- Filters Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex gap-3 flex-wrap">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusFilter" id="all" checked>
                            <label class="form-check-label" for="all">
                                Tous les véhicules
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusFilter" id="available">
                            <label class="form-check-label" for="available">
                                <span class="badge bg-success">Disponibles</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusFilter" id="reserved">
                            <label class="form-check-label" for="reserved">
                                <span class="badge bg-warning">Réservés</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <span class="text-muted">
                        <i class="fas fa-car me-1"></i>
                        {{ $vehicles->count() }} véhicules disponibles
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicles Grid -->
    <div class="row g-4">
        @forelse($vehicles as $vehicle)
            <div class="col-lg-4 col-md-6 vehicle-item" data-status="{{ $vehicle->status }}">
                <div class="card vehicle-card h-100">
                    <!-- Vehicle Image -->
                    @if($vehicle->image_path)
                        <div class="position-relative">
                            <img src="{{ asset('pictures/' . $vehicle->image_path) }}" 
                                 class="card-img-top" 
                                 alt="{{ $vehicle->marque }} {{ $vehicle->model }}">
                            
                            <!-- Price Tag -->
                            <div class="price-tag">
                                {{ number_format($vehicle->prix, 0) }} DH/jour
                            </div>
                            
                            <!-- Status Badge -->
                            <div class="status-badge {{ $vehicle->status === 'available' ? 'status-available' : ($vehicle->status === 'reserved' ? 'status-reserved' : 'status-maintenance') }}">
                                {{ $vehicle->status === 'available' ? 'Disponible' : ($vehicle->status === 'reserved' ? 'Réservé' : 'Maintenance') }}
                            </div>
                        </div>
                    @else
                        <div class="position-relative">
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 280px;">
                                <i class="fas fa-car fa-4x text-muted"></i>
                            </div>
                            
                            <!-- Price Tag -->
                            <div class="price-tag">
                                {{ number_format($vehicle->prix, 0) }} DH/jour
                            </div>
                            
                            <!-- Status Badge -->
                            <div class="status-badge {{ $vehicle->status === 'available' ? 'status-available' : ($vehicle->status === 'reserved' ? 'status-reserved' : 'status-maintenance') }}">
                                {{ $vehicle->status === 'available' ? 'Disponible' : ($vehicle->status === 'reserved' ? 'Réservé' : 'Maintenance') }}
                            </div>
                        </div>
                    @endif

                    <!-- Vehicle Details -->
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-2">{{ $vehicle->marque }} {{ $vehicle->model }}</h5>
                        <p class="card-text text-muted mb-3">{{ Str::limit($vehicle->description, 120) }}</p>
                        
                        <!-- Vehicle Specs -->
                        <div class="vehicle-specs mb-3">
                            <div class="row text-center">
                                <div class="col-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-id-card me-1"></i>Plaque
                                    </small>
                                    <strong>{{ $vehicle->license_plate }}</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-tag me-1"></i>Prix
                                    </small>
                                    <strong class="text-primary">{{ number_format($vehicle->prix, 0) }} DH</strong>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-primary">
                                <i class="fas fa-eye me-2"></i>Voir les détails
                            </a>
                            @if($vehicle->status === 'available')
                                <a href="{{ route('reservations.create', ['vehicle_id' => $vehicle->id]) }}" class="btn btn-outline-success">
                                    <i class="fas fa-calendar-check me-2"></i>Réserver
                                </a>
                            @else
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fas fa-clock me-2"></i>Non disponible
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-car fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun véhicule disponible</h4>
                    <p class="text-muted">Nous n'avons pas de véhicules à afficher pour le moment.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Quick Actions -->
    <div class="text-center mt-5">
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('reservations.create') }}" class="btn btn-outline-primary w-100 py-3">
                    <i class="fas fa-calendar-plus fa-2x mb-2"></i>
                    <br>Nouvelle Réservation
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('reservations.index') }}" class="btn btn-outline-info w-100 py-3">
                    <i class="fas fa-list fa-2x mb-2"></i>
                    <br>Mes Réservations
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 py-3">
                    <i class="fas fa-home fa-2x mb-2"></i>
                    <br>Retour Accueil
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for filtering -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterInputs = document.querySelectorAll('input[name="statusFilter"]');
    const vehicleItems = document.querySelectorAll('.vehicle-item');

    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            const selectedStatus = this.id;
            
            vehicleItems.forEach(item => {
                const itemStatus = item.dataset.status;
                
                if (selectedStatus === 'all' || selectedStatus === itemStatus) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection
