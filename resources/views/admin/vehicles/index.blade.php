@extends('layouts.app')

@section('content')
<style>
    .vehicle-image {
        height: 60px;
        width: 60px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #e9ecef;
    }
    
    .vehicle-placeholder {
        height: 60px;
        width: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid #e9ecef;
    }

    .action-buttons form {
        display: inline;
    }

    .table td {
        vertical-align: middle;
        font-family: 'Inter', sans-serif;
    }

    /* Style pour les badges */
    .badge-available {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 20px;
        font-family: 'Inter', sans-serif;
    }

    .badge-reserved {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        color: white;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 20px;
        font-family: 'Inter', sans-serif;
    }

    .badge-maintenance {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 20px;
        font-family: 'Inter', sans-serif;
    }

    /* Titre centré */
    .title {
        font-family: 'Inter', sans-serif;
        color: #1a1a1a;
        text-align: center;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    /* Bouton personnalisé */
    .btn-custom {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border: none;
        color: white;
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        border-radius: 12px;
        padding: 12px 24px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        color: white;
        text-decoration: none;
    }

    /* Forcer la couleur noire sur les titres des colonnes */
    th {
        color: #1a1a1a !important;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        border-bottom: 2px solid #e9ecef;
        padding: 16px 12px;
    }

    /* Changer les couleurs des boutons de modifier et supprimer */
    .btn-edit {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border: none;
        color: white;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        border-radius: 8px;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        color: white;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        border-radius: 8px;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220,53,69,0.3);
        color: white;
    }

    .table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: white;
    }

    .table tbody tr:hover {
        background-color: #f1f3f4;
        transition: background-color 0.3s ease;
    }

    .container {
        padding: 2rem 0;
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
</style>

<div class="container">
    <div class="row mb-5">
        <div class="col-md-12">
            <h1 class="title">
                <i class="fas fa-car me-3"></i>Gestion des Véhicules
            </h1>
            <p class="text-center text-muted" style="font-family: 'Inter', sans-serif; font-size: 1.1rem;">
                Gérez votre flotte de véhicules disponibles
            </p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <a href="{{ route('admin.vehicles.create') }}" class="btn-custom">
                <i class="fas fa-plus"></i> Ajouter un Véhicule
            </a>
        </div>
    </div>

    @if($vehicles->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Aucun véhicule disponible pour le moment.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><i class="fas fa-image me-2"></i>Image</th>
                        <th><i class="fas fa-car me-2"></i>Marque & Modèle</th>
                        <th><i class="fas fa-id-card me-2"></i>Matricule</th>
                        <th><i class="fas fa-money-bill-wave me-2"></i>Prix/Jour</th>
                        <th><i class="fas fa-check-circle me-2"></i>Disponibilité</th>
                        <th><i class="fas fa-cogs me-2"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>
                                @if($vehicle->image_path)
                                    <img src="{{ asset('pictures/' . $vehicle->image_path) }}" 
                                         alt="{{ $vehicle->marque }} {{ $vehicle->model }}" 
                                         class="vehicle-image">
                                @else
                                    <div class="vehicle-placeholder">
                                        <i class="fas fa-car fa-lg text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong style="font-family: 'Inter', sans-serif;">{{ $vehicle->marque }} {{ $vehicle->model }}</strong>
                            </td>
                            <td>
                                <code style="background: #f8f9fa; padding: 4px 8px; border-radius: 6px; font-family: 'Inter', sans-serif;">
                                    {{ $vehicle->license_plate }}
                                </code>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #1a1a1a; font-family: 'Inter', sans-serif;">
                                    {{ number_format($vehicle->prix, 2) }} DH
                                </span>
                            </td>
                            <td>
                                <span class="badge 
                                    {{ $vehicle->status === 'available' ? 'badge-available' : 
                                    ($vehicle->status === 'reserved' ? 'badge-reserved' : 'badge-maintenance') }}">
                                    <i class="fas {{ $vehicle->status === 'available' ? 'fa-check' : 
                                    ($vehicle->status === 'reserved' ? 'fa-clock' : 'fa-tools') }} me-1"></i>
                                    {{ $vehicle->status === 'available' ? 'Disponible' : 
                                    ($vehicle->status === 'reserved' ? 'Réservé' : 'Maintenance') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" 
                                       class="btn btn-sm btn-edit">
                                        <i class="fas fa-edit me-1"></i> Modifier
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-delete"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')">
                                        <i class="fas fa-trash me-1"></i> Supprimer
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
