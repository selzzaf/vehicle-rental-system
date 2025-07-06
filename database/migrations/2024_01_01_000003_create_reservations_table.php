<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create Reservations Table Migration
 * 
 * This migration creates the reservations table which manages the relationship
 * between users and vehicles. Each reservation record tracks rental periods,
 * status, and administrative information.
 * 
 * Table Structure:
 * - id: Primary key (auto-increment)
 * - user_id: Foreign key to users table
 * - vehicle_id: Foreign key to vehicles table
 * - start_date: Reservation start date and time
 * - end_date: Reservation end date and time
 * - notes: Optional user notes
 * - status: Reservation approval status
 * - admin_notes: Optional administrative notes
 * - timestamps: Created and updated timestamps
 * 
 * Relationships:
 * - Belongs to User (many-to-one)
 * - Belongs to Vehicle (many-to-one)
 * 
 * @author Your Name
 * @version 1.0
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates the reservations table with foreign key relationships to users
     * and vehicles tables. Includes proper indexing and constraints for
     * data integrity and performance.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            // Primary key
            $table->id();
            
            // Foreign key relationships
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');        // Delete reservations when user is deleted
            
            $table->foreignId('vehicle_id')
                  ->constrained()
                  ->onDelete('cascade');        // Delete reservations when vehicle is deleted
            
            // Reservation period
            $table->datetime('start_date');     // When the rental period begins
            $table->datetime('end_date');       // When the rental period ends
            
            // User and admin notes
            $table->text('notes')->nullable();  // Optional notes from the user
            
            // Reservation status tracking
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])
                  ->default('pending');         // Current status of the reservation
            
            $table->text('admin_notes')->nullable();  // Optional notes from administrators
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Drops the reservations table and all associated data.
     * This method is called when rolling back the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}; 