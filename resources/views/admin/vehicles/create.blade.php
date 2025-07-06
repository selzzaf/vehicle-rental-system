@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 style="font-family: 'Inter', sans-serif; color: #1a1a1a; font-weight: 700; font-size: 2.5rem;">
                    <i class="fas fa-car me-3"></i>Ajouter un Véhicule
                </h1>
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-dark" 
                   style="font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 12px; padding: 12px 24px; transition: all 0.3s ease;">
                    <i class="fas fa-arrow-left me-2"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg border-0" style="border-radius: 20px; background: white;">
                <div class="card-header py-4" 
                     style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-radius: 20px 20px 0 0; border: none;">
                    <h5 class="m-0" style="font-weight: 600; color: white; font-family: 'Inter', sans-serif;">
                        <i class="fas fa-plus-circle me-2"></i>Informations du Véhicule
                    </h5>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="marque" class="form-label" 
                                           style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                                        <i class="fas fa-tag me-2"></i>Marque
                                    </label>
                                    <input type="text" class="form-control @error('marque') is-invalid @enderror" 
                                           id="marque" name="marque" value="{{ old('marque') }}" required
                                           style="border-radius: 12px; border: 2px solid #e9ecef; padding: 12px; font-family: 'Inter', sans-serif; transition: border-color 0.3s ease;">
                                    @error('marque')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="model" class="form-label" 
                                           style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                                        <i class="fas fa-car me-2"></i>Modèle
                                    </label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                           id="model" name="model" value="{{ old('model') }}" required
                                           style="border-radius: 12px; border: 2px solid #e9ecef; padding: 12px; font-family: 'Inter', sans-serif; transition: border-color 0.3s ease;">
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label" 
                                   style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                                <i class="fas fa-align-left me-2"></i>Description
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required
                                      style="border-radius: 12px; border: 2px solid #e9ecef; padding: 12px; font-family: 'Inter', sans-serif; transition: border-color 0.3s ease;">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="prix" class="form-label" 
                                           style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                                        <i class="fas fa-money-bill-wave me-2"></i>Prix par jour (DH)
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('prix') is-invalid @enderror" 
                                           id="prix" 
                                           name="prix" 
                                           value="{{ old('prix') }}" 
                                           step="0.01" 
                                           required
                                           style="border-radius: 12px; border: 2px solid #e9ecef; padding: 12px; font-family: 'Inter', sans-serif; transition: border-color 0.3s ease;">
                                    @error('prix')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="license_plate" class="form-label" 
                                           style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                                        <i class="fas fa-id-card me-2"></i>Matricule
                                    </label>
                                    <input type="text" class="form-control @error('license_plate') is-invalid @enderror" 
                                           id="license_plate" name="license_plate" value="{{ old('license_plate') }}" required
                                           style="border-radius: 12px; border: 2px solid #e9ecef; padding: 12px; font-family: 'Inter', sans-serif; transition: border-color 0.3s ease;">
                                    @error('license_plate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="status" class="form-label" 
                                           style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                                        <i class="fas fa-check-circle me-2"></i>Disponibilité
                                    </label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required
                                            style="border-radius: 12px; border: 2px solid #e9ecef; padding: 12px; font-family: 'Inter', sans-serif; transition: border-color 0.3s ease;">
                                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>En Maintenance</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="image" class="form-label" 
                                           style="font-family: 'Inter', sans-serif; font-weight: 600; color: #1a1a1a; margin-bottom: 8px;">
                                        <i class="fas fa-image me-2"></i>Image du Véhicule
                                    </label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*" required
                                           onchange="saveImageToStorage(this)"
                                           style="border-radius: 12px; border: 2px solid #e9ecef; padding: 12px; font-family: 'Inter', sans-serif; transition: border-color 0.3s ease;">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="image_path" id="image_path">

                        <div class="d-grid gap-2 mt-5">
                            <button type="submit" 
                                    class="btn btn-dark" 
                                    style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border: none; color: white; font-family: 'Inter', sans-serif; font-weight: 600; border-radius: 12px; padding: 16px; transition: all 0.3s ease;">
                                <i class="fas fa-plus-circle me-2"></i> Créer le Véhicule
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #1a1a1a !important;
        box-shadow: 0 0 0 0.2rem rgba(26, 26, 26, 0.25) !important;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
    }
</style>

<script>
function saveImageToStorage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const fileName = file.name;
        
        // Create FormData object
        const formData = new FormData();
        formData.append('image', file);

        // Send file to storage
        fetch('/admin/vehicles/upload-image', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById('image_path').value = fileName;
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>
@endsection 