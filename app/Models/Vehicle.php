<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Vehicle Model
 * 
 * Represents a vehicle in the rental system. This model handles all vehicle-related
 * data including basic information, pricing, availability status, and relationships
 * with reservations.
 * 
 * @property int $id
 * @property string $marque Vehicle brand/manufacturer
 * @property string $model Vehicle model name
 * @property string $description Detailed vehicle description
 * @property decimal $prix Daily rental price
 * @property string $license_plate Unique license plate number
 * @property string $status Current status (available, reserved, maintenance)
 * @property string|null $image_path Path to vehicle image file
 * @property bool $is_available Availability flag
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @author Your Name
 * @version 1.0
 */
class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * These fields can be filled using mass assignment methods like create() or fill().
     * This includes all the essential vehicle information that can be set during creation
     * or updates.
     *
     * @var array<string>
     */
    protected $fillable = [
        'marque',
        'model',
        'description',
        'prix',
        'license_plate',
        'status',
        'image_path',
        'is_available'
    ];

    /**
     * Get all reservations for this vehicle.
     * 
     * Establishes a one-to-many relationship with the Reservation model.
     * A vehicle can have multiple reservations over time, but only one active
     * reservation at a time (enforced by business logic).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get the full URL for the vehicle's image.
     * 
     * This accessor automatically generates the complete URL for the vehicle's image.
     * If no image is set or the file doesn't exist, it returns a default image.
     * The method checks if the image file exists in the public/pictures directory
     * before returning the URL.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        // Check if image path exists and file exists in public directory
        if ($this->image_path && file_exists(public_path('pictures/' . $this->image_path))) {
            return asset('pictures/' . $this->image_path);
        }
        
        // Return default image if no custom image is available
        return asset('images/default-car.jpg');
    }
}
