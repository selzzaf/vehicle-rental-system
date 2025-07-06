@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #8B004B; color: white; border-radius: 10px 10px 0 0;">
                    <h4 style="font-family: 'Courier New', monospace; font-weight: bold; text-align: center; flex-grow: 1;">Modifier réservation</h4>
                    <a href="{{ route('reservations.index') }}" class="btn" style="background-color: #F48FB1; color: white; font-family: 'Courier New', monospace; font-weight: bold; border-radius: 5px;">
                        <i class="fas fa-arrow-left"></i> Retour 
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" style="font-family: 'Courier New', monospace; font-weight: bold;">Voiture</label>
                            <div class="form-control bg-light" style="font-family: 'Courier New', monospace;">
                                {{ $reservation->vehicle->marque }} {{ $reservation->vehicle->model }} - {{ $reservation->vehicle->license_plate }}
                                ({{ number_format($reservation->vehicle->prix, 2) }}DH par jour)
                            </div>
                            <input type="hidden" name="vehicle_id" value="{{ $reservation->vehicle_id }}">
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label" style="font-family: 'Courier New', monospace; font-weight: bold;">Date de début</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                   id="start_date" name="start_date" 
                                   value="{{ old('start_date', $reservation->start_date->format('Y-m-d')) }}" 
                                   required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label" style="font-family: 'Courier New', monospace; font-weight: bold;">Date de fin</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                   id="end_date" name="end_date" 
                                   value="{{ old('end_date', $reservation->end_date->format('Y-m-d')) }}" 
                                   required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="font-family: 'Courier New', monospace; font-weight: bold; background-color: #8B004B; color: white; border-radius: 5px;">
                                <i class="fas fa-save"></i> Sauvegarder les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Informations sur la réservation actuelle -->
            <div class="card mt-4" style="border: 2px solid #8B004B; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background-color: #8B004B; color: white; border-radius: 10px 10px 0 0;">
                    <h5 class="mb-0" style="font-family: 'Courier New', monospace; font-weight: bold;">Informations sur la réservation</h5>
                </div>
                <div class="card-body" style="font-family: 'Courier New', monospace;">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Voiture actuelle:</strong><br>
                                {{ $reservation->vehicle->marque }} {{ $reservation->vehicle->model }}</p>
                            <p><strong>Client:</strong><br>
                                {{ $reservation->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Créée le:</strong><br>
                                {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Dernière modification:</strong><br>
                                {{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    startDateInput.addEventListener('change', function() {
        const startDate = new Date(this.value);
        const minEndDate = new Date(startDate);
        minEndDate.setDate(startDate.getDate() + 1);
        endDateInput.min = minEndDate.toISOString().split('T')[0];
        
        if (endDateInput.value && new Date(endDateInput.value) <= startDate) {
            endDateInput.value = minEndDate.toISOString().split('T')[0];
        }
    });
});
</script>
@endsection
