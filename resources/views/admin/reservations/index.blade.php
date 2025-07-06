@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-12">
            <h1 class="text-center mb-4" style="color: #1a1a1a; font-family: 'Inter', sans-serif; font-weight: 700; font-size: 2.5rem;">
                <i class="fas fa-calendar-check me-3"></i>Gestion des Réservations
            </h1>
            <p class="text-center text-muted" style="font-family: 'Inter', sans-serif; font-size: 1.1rem;">
                Gérez et suivez toutes les réservations de votre plateforme
            </p>
        </div>
    </div>

    @if($reservations->isEmpty())
        <div class="alert alert-info" style="border-radius: 12px; font-family: 'Inter', sans-serif; border: none; padding: 1rem 1.5rem;">
            <i class="fas fa-info-circle me-2"></i>
            Aucune réservation trouvée pour le moment.
        </div>
    @else
        <div class="row g-4">
            @foreach($reservations as $reservation)
                <div class="col-md-6 mb-4 reservation-card" 
                     data-status="{{ $reservation->status }}"
                     data-date="{{ $reservation->start_date->format('Y-m-d') }}">
                    <div class="card h-100 shadow-lg border-0" style="border-radius: 16px; transition: transform 0.3s ease;">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center" 
                             style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 16px 16px 0 0; border: none;">
                            <div>
                                <span class="badge {{ 
                                    $reservation->status === 'approved' ? 'bg-success' : 
                                    ($reservation->status === 'pending' ? 'bg-warning' : 
                                    ($reservation->status === 'rejected' ? 'bg-danger' : 'bg-secondary')) 
                                }} text-uppercase fw-bold" style="font-family: 'Inter', sans-serif; padding: 8px 16px; border-radius: 20px;">
                                    <i class="fas {{ 
                                        $reservation->status === 'approved' ? 'fa-check' : 
                                        ($reservation->status === 'pending' ? 'fa-clock' : 
                                        ($reservation->status === 'rejected' ? 'fa-times' : 'fa-ban')) 
                                    }} me-1"></i>
                                    {{ 
                                        $reservation->status === 'approved' ? 'Confirmée' : 
                                        ($reservation->status === 'pending' ? 'En Attente' : 
                                        ($reservation->status === 'rejected' ? 'Rejetée' : 'Annulée'))
                                    }}
                                </span>
                            </div>
                            <small class="text-light" style="font-family: 'Inter', sans-serif;">
                                <i class="fas fa-calendar me-1"></i>{{ $reservation->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <div class="card-body p-4">
                            <!-- Structure des données sous forme de liste -->
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-user text-dark me-3" style="font-size: 1.2rem;"></i>
                                        <div>
                                            <strong style="font-family: 'Inter', sans-serif; color: #1a1a1a;">{{ $reservation->user->name }}</strong>
                                            <br><small class="text-muted" style="font-family: 'Inter', sans-serif;">{{ $reservation->user->email }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-car text-dark me-3" style="font-size: 1.2rem;"></i>
                                        <div>
                                            <strong style="font-family: 'Inter', sans-serif; color: #1a1a1a;">{{ $reservation->vehicle->marque }} {{ $reservation->vehicle->model }}</strong>
                                            <br><small class="text-muted" style="font-family: 'Inter', sans-serif;">{{ $reservation->vehicle->license_plate }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-calendar-alt text-dark me-3" style="font-size: 1.2rem;"></i>
                                        <div>
                                            <strong style="font-family: 'Inter', sans-serif; color: #1a1a1a;">Période de location</strong>
                                            <br><small class="text-muted" style="font-family: 'Inter', sans-serif;">
                                                Du {{ $reservation->start_date->format('d/m/Y') }} au {{ $reservation->end_date->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-money-bill-wave text-dark me-3" style="font-size: 1.2rem;"></i>
                                        <div>
                                            <strong style="font-family: 'Inter', sans-serif; color: #1a1a1a;">{{ number_format($reservation->vehicle->prix, 2) }} DH/jour</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($reservation->status === 'pending')
                                <div class="alert alert-warning mt-3" style="border-radius: 12px; font-family: 'Inter', sans-serif; border: none;">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Cette réservation nécessite votre confirmation.
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <button type="button" 
                                            class="btn btn-success"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#approveModal{{ $reservation->id }}"
                                            style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 8px; padding: 8px 16px;">
                                        <i class="fas fa-check me-1"></i> Confirmer
                                    </button>
                                    <button type="button" 
                                            class="btn btn-danger"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#rejectModal{{ $reservation->id }}"
                                            style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 8px; padding: 8px 16px;">
                                        <i class="fas fa-times me-1"></i> Refuser
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal d'approbation -->
                <div class="modal fade" id="approveModal{{ $reservation->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="border-radius: 16px; border: none;">
                            <form action="{{ route('admin.reservations.approve', $reservation) }}" method="POST">
                                @csrf
                                <div class="modal-header" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 16px 16px 0 0; border: none;">
                                    <h5 class="modal-title" style="color: white; font-family: 'Inter', sans-serif; font-weight: 600;">
                                        <i class="fas fa-check-circle me-2"></i>Confirmer la Réservation
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4" style="font-family: 'Inter', sans-serif;">
                                    <p>Êtes-vous sûr de vouloir confirmer cette réservation ?</p>
                                    <div class="alert alert-info" style="border-radius: 12px; border: none;">
                                        <strong>Client:</strong> {{ $reservation->user->name }}<br>
                                        <strong>Véhicule:</strong> {{ $reservation->vehicle->marque }} {{ $reservation->vehicle->model }}<br>
                                        <strong>Période:</strong> {{ $reservation->start_date->format('d/m/Y') }} - {{ $reservation->end_date->format('d/m/Y') }}
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" 
                                            style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 8px;">
                                        <i class="fas fa-times me-1"></i> Annuler
                                    </button>
                                    <button type="submit" class="btn btn-success" 
                                            style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 8px;">
                                        <i class="fas fa-check me-1"></i> Confirmer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal de rejet -->
                <div class="modal fade" id="rejectModal{{ $reservation->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="border-radius: 16px; border: none;">
                            <form action="{{ route('admin.reservations.reject', $reservation) }}" method="POST">
                                @csrf
                                <div class="modal-header" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 16px 16px 0 0; border: none;">
                                    <h5 class="modal-title" style="color: white; font-family: 'Inter', sans-serif; font-weight: 600;">
                                        <i class="fas fa-times-circle me-2"></i>Refuser la Réservation
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4" style="font-family: 'Inter', sans-serif;">
                                    <p>Êtes-vous sûr de vouloir refuser cette réservation ?</p>
                                    <div class="alert alert-warning" style="border-radius: 12px; border: none;">
                                        <strong>Client:</strong> {{ $reservation->user->name }}<br>
                                        <strong>Véhicule:</strong> {{ $reservation->vehicle->marque }} {{ $reservation->vehicle->model }}<br>
                                        <strong>Période:</strong> {{ $reservation->start_date->format('d/m/Y') }} - {{ $reservation->end_date->format('d/m/Y') }}
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" 
                                            style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 8px;">
                                        <i class="fas fa-times me-1"></i> Annuler
                                    </button>
                                    <button type="submit" class="btn btn-danger" 
                                            style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 8px;">
                                        <i class="fas fa-times me-1"></i> Refuser
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
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
    
    .badge {
        font-size: 0.9em;
        padding: 0.5em 1em;
        color: white;
        font-family: 'Inter', sans-serif;
        font-weight: 600;
    }
    
    .alert {
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        border: none;
        padding: 1rem 1.5rem;
    }
    
    .alert-info {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        color: #1565c0;
    }
    
    .alert-warning {
        background: linear-gradient(135deg, #fff3e0 0%, #ffcc02 100%);
        color: #e65100;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');
    const cards = document.querySelectorAll('.reservation-card');
    
    // Fonction de filtrage (si vous ajoutez des filtres plus tard)
    function filterCards() {
        // Logique de filtrage à implémenter si nécessaire
    }
});
</script>
@endsection
