<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create Vehicles Table Migration
 * 
 * This migration creates the vehicles table which stores all vehicle information
 * for the rental system. Each vehicle record contains basic details, pricing,
 * availability status, and image references.
 * 
 * Table Structure:
 * - id: Primary key (auto-increment)
 * - marque: Vehicle brand/manufacturer
 * - model: Vehicle model name
 * - description: Detailed vehicle description
 * - prix: Daily rental price (decimal with 2 decimal places)
 * - license_plate: Unique license plate number
 * - status: Current availability status
 * - image_path: Optional path to vehicle image
 * - timestamps: Created and updated timestamps
 * 
 * @author Your Name
 * @version 1.0
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates the vehicles table with all necessary columns for vehicle management.
     * The table includes constraints for data integrity and proper indexing.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            // Primary key
            $table->id();
            
            // Vehicle identification
            $table->string('marque');           // Brand/manufacturer (e.g., "Toyota", "BMW")
            $table->string('model');            // Model name (e.g., "Camry", "X5")
            $table->text('description');        // Detailed description of the vehicle
            
            // Pricing information
            $table->decimal('prix', 8, 2);      // Daily rental price (max 999999.99)
            
            // Vehicle registration
            $table->string('license_plate')->unique();  // Unique license plate number
            
            // Availability status
            $table->enum('status', ['available', 'reserved', 'maintenance'])
                  ->default('available');       // Current status of the vehicle
            
            // Media
            $table->string('image_path')->nullable();   // Path to vehicle image file
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * Drops the vehicles table and all associated data.
     * This method is called when rolling back the migration.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
}; 