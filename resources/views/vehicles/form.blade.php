<form action="{{ isset($vehicle) ? route('vehicles.update', $vehicle->id) : route('vehicles.store') }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf
    @if(isset($vehicle))
        @method('PUT')
    @endif

    <!-- Other form fields -->

    <div class="mb-3">
        <label for="image" class="form-label"> Image voiture</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" 
               id="image" name="image" accept="image/*">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if(isset($vehicle) && $vehicle->image_path)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $vehicle->image_path) }}" 
                     alt="Vehicle Image" 
                     class="img-thumbnail" 
                     style="max-width: 200px">
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Disponibilité</label>
        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="available" {{ old('status', $vehicle->status ?? '') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="reserved" {{ old('status', $vehicle->status ?? '') == 'reserved' ? 'selected' : '' }}>Reserved</option>
            <option value="maintenance" {{ old('status', $vehicle->status ?? '') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">
        {{ isset($vehicle) ? 'Update' : 'Create' }} Voiture
    </button>
</form> 