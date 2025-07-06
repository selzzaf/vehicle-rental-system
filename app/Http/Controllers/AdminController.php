<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * AdminController
 * 
 * Handles all administrative functions for the vehicle rental system.
 * This controller manages vehicle operations, reservation approvals,
 * user management, and system statistics. All methods require admin privileges.
 * 
 * Features:
 * - Dashboard with system statistics
 * - Vehicle CRUD operations with image upload
 * - Reservation management and approval workflow
 * - User management
 * 
 * @author Your Name
 * @version 1.0
 */
class AdminController extends Controller
{
    /**
     * Display the admin dashboard with system statistics.
     * 
     * Shows key metrics including total users, vehicle availability,
     * and active reservations. This provides administrators with
     * an overview of system health and usage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        // Get statistics for dashboard
        $totalUsers = User::count();                                    // Total registered users
        $availableVehicles = Vehicle::where('status', 'available')->count();  // Available vehicles
        $reservedVehicles = Vehicle::where('status', 'reserved')->count();     // Currently reserved vehicles
        $activeReservations = Reservation::where('end_date', '>', now())->count();  // Ongoing reservations

        return view('admin.dashboard', compact(
            'totalUsers',
            'availableVehicles',
            'reservedVehicles',
            'activeReservations'
        ));
    }

    /**
     * Display all vehicles in the system.
     * 
     * Shows a list of all vehicles with their current status,
     * allowing administrators to manage the vehicle fleet.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function vehicles()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     * 
     * Displays the vehicle creation form with fields for all
     * vehicle information including image upload.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createVehicle()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created vehicle in storage.
     * 
     * Validates vehicle data and handles image upload. Creates
     * the pictures directory if it doesn't exist and stores
     * the vehicle image with a unique filename.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeVehicle(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'marque' => 'required|string|max:255',           // Vehicle brand
            'model' => 'required|string|max:255',            // Vehicle model
            'description' => 'required|string',              // Vehicle description
            'prix' => 'required|numeric|min:0',              // Daily rental price
            'license_plate' => 'required|string|unique:vehicles',  // Unique license plate
            'status' => 'required|in:available,maintenance', // Initial status
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'  // Vehicle image
        ]);

        $vehicle = new Vehicle($request->except('image'));

        // Handle image upload
        if ($request->hasFile('image')) {
            // Create pictures directory if it doesn't exist
            if (!file_exists(public_path('pictures'))) {
                mkdir(public_path('pictures'), 0777, true);
            }
            
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();  // Unique filename
            
            // Move image to pictures directory
            $image->move(public_path('pictures'), $filename);
            
            // Save only the filename in database
            $vehicle->image_path = $filename;
        }

        $vehicle->save();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle created successfully.');
    }

    /**
     * Show the form for editing the specified vehicle.
     * 
     * Displays the vehicle edit form pre-populated with
     * current vehicle data.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editVehicle(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified vehicle in storage.
     * 
     * Validates updated vehicle data and handles image replacement.
     * Deletes the old image file if a new one is uploaded.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateVehicle(Request $request, Vehicle $vehicle) 
    {
        // Validate input data (license plate unique except current vehicle)
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'status' => 'required|in:available,maintenance,reserved',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload/replacement
        if ($request->hasFile('image')) {
            // Create pictures directory if it doesn't exist
            if (!file_exists(public_path('pictures'))) {
                mkdir(public_path('pictures'), 0777, true);
            }
            
            // Delete old image file
            if ($vehicle->image_path) {
                $oldImagePath = public_path('pictures/' . $vehicle->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save new image
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Move image to pictures directory
            $image->move(public_path('pictures'), $filename);
            
            // Save only the filename in database
            $vehicle->image_path = $filename;
        }

        $vehicle->fill($request->except('image'));
        $vehicle->save();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     * 
     * Deletes the vehicle and its associated image file.
     * This action is irreversible and will also delete any
     * associated reservations.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyVehicle(Vehicle $vehicle)
    {
        // Delete associated image file
        if ($vehicle->image_path) {
            $imagePath = public_path('pictures/' . $vehicle->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }

    /**
     * Display all reservations in the system.
     * 
     * Shows a list of all reservations with user and vehicle
     * information, allowing administrators to manage the
     * reservation approval workflow.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reservations()
    {
        $reservations = Reservation::with(['user', 'vehicle'])->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Cancel a reservation and free up the vehicle.
     * 
     * Deletes the reservation and sets the vehicle status
     * back to available. This action is irreversible.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyReservation(Reservation $reservation)
    {
        // Free up the vehicle
        $vehicle = $reservation->vehicle;
        $vehicle->status = 'available';
        $vehicle->save();
        
        $reservation->delete();
        
        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservation cancelled successfully.');
    }

    /**
     * Approve a pending reservation.
     * 
     * Changes reservation status to approved and sets vehicle
     * status to reserved. Only pending reservations can be approved.
     * Includes validation to ensure vehicle is still available.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveReservation(Request $request, Reservation $reservation)
    {
        // Check if reservation can still be approved
        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Cette réservation ne peut plus être confirmée.');
        }

        // Verify vehicle is still available
        if ($reservation->vehicle->status !== 'available') {
            return back()->with('error', 'Le véhicule n\'est plus disponible.');
        }

        // Approve the reservation
        $reservation->status = 'approved';
        $reservation->admin_notes = $request->admin_notes;
        $reservation->save();

        // Update vehicle status to reserved
        $reservation->vehicle->status = 'reserved';
        $reservation->vehicle->save();

        // TODO: Send confirmation email to customer

        return back()->with('success', 'Réservation confirmée avec succès.');
    }

    /**
     * Reject a pending reservation.
     * 
     * Changes reservation status to rejected with required
     * administrative notes explaining the rejection reason.
     * Vehicle remains available for other reservations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectReservation(Request $request, Reservation $reservation)
    {
        // Check if reservation can still be rejected
        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Cette réservation ne peut plus être rejetée.');
        }

        // Validate rejection reason
        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ], [
            'admin_notes.required' => 'Veuillez indiquer le motif du rejet.'
        ]);

        // Reject the reservation
        $reservation->status = 'rejected';
        $reservation->admin_notes = $request->admin_notes;
        $reservation->save();

        // Vehicle remains available
        // TODO: Send notification email to customer

        return back()->with('success', 'Réservation rejetée avec succès.');
    }
}