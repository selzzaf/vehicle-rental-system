@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="section-title">Mes Réservations</h2>
                    <p class="text-muted">Gérez vos réservations de véhicules</p>
                </div>
                <a href="{{ route('reservations.create') }}" class="btn btn-dark">
                    <i class="fas fa-plus me-2"></i>Nouvelle réservation
                </a>
            </div>
        </div>
    </div>

    @if($reservations->isEmpty())
        <div class="text-center py-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted mb-3">Aucune réservation</h4>
                    <p class="text-muted mb-4">Vous n'avez pas encore de réservations. Commencez par réserver un véhicule !</p>
                    <a href="{{ route('reservations.create') }}" class="btn btn-dark">
                        <i class="fas fa-calendar-plus me-2"></i>Faire ma première réservation
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($reservations as $reservation)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg h-100">
                        <div class="card-body p-4">
                            <!-- Vehicle Info -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-car text-primary fa-lg"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $reservation->vehicle->marque }} {{ $reservation->vehicle->model }}</h5>
                                    <small class="text-muted">{{ $reservation->vehicle->license_plate }}</small>
                                </div>
                            </div>

                            <!-- Reservation Details -->
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-plus text-success me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Début</small>
                                            <strong>{{ $reservation->start_date->format('d/m/Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-minus text-danger me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">Fin</small>
                                            <strong>{{ $reservation->end_date->format('d/m/Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="mb-4">
                                <span class="status-badge {{ 
                                    $reservation->status === 'approved' ? 'status-approved' : 
                                    ($reservation->status === 'pending' ? 'status-pending' : 
                                    ($reservation->status === 'rejected' ? 'status-rejected' : 'status-cancelled')) 
                                }}">
                                    <i class="fas fa-{{ 
                                        $reservation->status === 'approved' ? 'check-circle' : 
                                        ($reservation->status === 'pending' ? 'clock' : 
                                        ($reservation->status === 'rejected' ? 'times-circle' : 'ban')) 
                                    }} me-1"></i>
                                    {{ 
                                        $reservation->status === 'approved' ? 'Confirmée' : 
                                        ($reservation->status === 'pending' ? 'En attente' : 
                                        ($reservation->status === 'rejected' ? 'Rejetée' : 'Annulée'))
                                    }}
                                </span>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex gap-2">
                                @if($reservation->status === 'pending')
                                    <a href="{{ route('reservations.edit', $reservation) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit me-1"></i>Modifier
                                    </a>
                                @endif
                                <button type="button" 
                                        class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $reservation->id }}">
                                    <i class="fas fa-times me-1"></i>Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal{{ $reservation->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 shadow-lg">
                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-bold">Confirmer l'annulation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Êtes-vous sûr de vouloir annuler cette réservation ?</p>
                                @if($reservation->status === 'approved')
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Cette réservation a été confirmée. L'annulation peut entraîner des frais.
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Non, garder
                                </button>
                                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash me-1"></i>Oui, annuler
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.status-approved {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.status-pending {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.status-rejected {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.status-cancelled {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
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

.btn-outline-primary {
    border: 2px solid #3b82f6;
    color: #3b82f6;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: #3b82f6;
    color: white;
    transform: translateY(-1px);
}

.btn-outline-danger {
    border: 2px solid #ef4444;
    color: #ef4444;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-danger:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-1px);
}
</style>
@endsection
