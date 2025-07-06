@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="text-center mb-4">
                <h2 class="section-title">Nouvelle Réservation</h2>
                <p class="text-muted">Réservez votre véhicule en quelques étapes simples</p>
            </div>
            
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="vehicle_id" class="form-label fw-bold text-dark">
                                <i class="fas fa-car me-2"></i>Véhicule
                            </label>
                            <select name="vehicle_id" id="vehicle_id" 
                                    class="form-control form-control-lg @error('vehicle_id') is-invalid @enderror" required>
                                <option value="">Sélectionnez un véhicule</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" 
                                            {{ (old('vehicle_id', request()->get('vehicle_id')) == $vehicle->id) ? 'selected' : '' }}>
                                        {{ $vehicle->marque }} {{ $vehicle->model }} - {{ $vehicle->license_plate }}
                                        ({{ number_format($vehicle->prix, 0) }} DH/jour)
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="start_date" class="form-label fw-bold text-dark">
                                        <i class="fas fa-calendar-plus me-2"></i>Date de début
                                    </label>
                                    <input type="date" class="form-control form-control-lg @error('start_date') is-invalid @enderror" 
                                           id="start_date" name="start_date" value="{{ old('start_date') }}" 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="end_date" class="form-label fw-bold text-dark">
                                        <i class="fas fa-calendar-minus me-2"></i>Date de fin
                                    </label>
                                    <input type="date" class="form-control form-control-lg @error('end_date') is-invalid @enderror" 
                                           id="end_date" name="end_date" value="{{ old('end_date') }}" 
                                           min="{{ date('Y-m-d', strtotime('+2 days')) }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label fw-bold text-dark">
                                <i class="fas fa-sticky-note me-2"></i>Notes (optionnel)
                            </label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3" 
                                      placeholder="Ajoutez des informations supplémentaires...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-dark btn-lg">
                                <i class="fas fa-calendar-check me-2"></i>Confirmer la réservation
                            </button>

                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                        </div>
                    </form>
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

<style>
.form-control {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #1f2937;
    box-shadow: 0 0 0 0.2rem rgba(31, 41, 55, 0.25);
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

.btn-outline-secondary {
    border: 2px solid #6b7280;
    color: #6b7280;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background: #6b7280;
    color: white;
    transform: translateY(-2px);
}
</style>
@endsection
