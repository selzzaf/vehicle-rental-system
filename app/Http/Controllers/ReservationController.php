<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->is_admin ? 
            Reservation::with(['user', 'vehicle'])->get() :
            Reservation::where('user_id', auth()->id())->with('vehicle')->get();
            
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        return view('reservations.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string|max:1000'
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);
        
        if ($vehicle->status !== 'available') {
            return back()->with('error', 'Ce véhicule n\'est plus disponible.');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending'; // Statut initial : en attente de confirmation
        $reservation = Reservation::create($validated);

        // Le véhicule reste disponible jusqu'à la confirmation
        return redirect()->route('reservations.index')
            ->with('success', 'Succès attendez de confirmation.');
    }

    public function show(Reservation $reservation)
    {
        if (!auth()->user()->is_admin && $reservation->user_id !== auth()->id()) {
            return redirect()->route('reservations.index')
                ->with('error', 'pas autorisé à voir cette réservation.');
        }
        
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        // Vérifie si l'utilisateur est propriétaire de la réservation
        if ($reservation->user_id !== auth()->id()) {
            return redirect()->route('reservations.index')
                ->with('error', 'pas autorisé à modifier  réservation.');
        }

        // Vérifie si la réservation est encore en attente
        if ($reservation->status !== 'pending') {
            return redirect()->route('reservations.index')
                ->with('error', 'déjà été traitée.');
        }

        $vehicles = Vehicle::where('status', 'available')
            ->orWhere('id', $reservation->vehicle_id)
            ->get();
            
        return view('reservations.edit', compact('reservation', 'vehicles'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        // Vérifie si l'utilisateur est propriétaire de la réservation
        if ($reservation->user_id !== auth()->id()) {
            return redirect()->route('reservations.index')
                ->with('error', ' pas autorisé à modifier .');
        }

        // Vérifie si la réservation est encore en attente
        if ($reservation->status !== 'pending') {
            return redirect()->route('reservations.index')
                ->with('error', ' déjà été traitée.');
        }

        $validated = $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string|max:1000'
        ]);

        $reservation->update($validated);

        return redirect()->route('reservations.index')
            ->with('success', ' mise à jour avec succès.');
    }

    public function destroy(Reservation $reservation)
    {
        // Vérifie si l'utilisateur est propriétaire de la réservation
        if ($reservation->user_id !== auth()->id()) {
            return redirect()->route('reservations.index')
                ->with('error', ' pas autorisé à annuler  réservation.');
        }

        // Met à jour le statut du véhicule si la réservation était approuvée
        if ($reservation->status === 'approved') {
            $reservation->vehicle->status = 'available';
            $reservation->vehicle->save();
        }

        $reservation->status = 'cancelled';
        $reservation->save();

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée .');
    }
}
