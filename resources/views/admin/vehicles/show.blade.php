<div class="vehicle-image-container mb-4">
    @if($vehicle->image_path)
        <img src="{{ asset('pictures/' . $vehicle->image_path) }}" 
             alt="{{ $vehicle->marque }} {{ $vehicle->model }}" 
             class="img-fluid rounded">
    @else
        <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded" 
             style="height: 200px;">
            <i class="fas fa-car fa-3x"></i>
        </div>
    @endif
</div>