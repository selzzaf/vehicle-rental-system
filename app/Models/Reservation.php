<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Reservation Model
 * 
 * Represents a vehicle reservation in the rental system. This model manages
 * the relationship between users and vehicles, including reservation dates,
 * status tracking, and administrative notes.
 * 
 * @property int $id
 * @property int $user_id Foreign key to users table
 * @property int $vehicle_id Foreign key to vehicles table
 * @property \Carbon\Carbon $start_date Reservation start date and time
 * @property \Carbon\Carbon $end_date Reservation end date and time
 * @property string|null $notes User notes for the reservation
 * @property string $status Reservation status (pending, approved, rejected, cancelled)
 * @property string|null $admin_notes Administrative notes for the reservation
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @author Your Name
 * @version 1.0
 */
class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * These fields can be filled using mass assignment methods. The user_id and
     * vehicle_id are typically set automatically based on relationships, while
     * dates and notes are provided by the user during reservation creation.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'start_date',
        'end_date',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     * 
     * Date fields are automatically cast to Carbon instances for easier
     * date manipulation and formatting. This allows for convenient date
     * operations like comparison, formatting, and timezone handling.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    /**
     * Get the user who made this reservation.
     * 
     * Establishes a many-to-one relationship with the User model.
     * Each reservation belongs to exactly one user who created it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the vehicle associated with this reservation.
     * 
     * Establishes a many-to-one relationship with the Vehicle model.
     * Each reservation is for exactly one vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
