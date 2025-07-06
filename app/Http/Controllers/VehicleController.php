<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'license_plate' => 'required|string|unique:vehicles',
            'status' => 'required|in:available,reserved,maintenance',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Créer le dossier pictures s'il n'existe pas
            if (!file_exists(public_path('pictures'))) {
                mkdir(public_path('pictures'), 0777, true);
            }
            
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            
            // Déplacer l'image dans le dossier pictures
            $image->move(public_path('pictures'), $filename);
            
            $validated['image_path'] = $filename;
        }

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule ajouté avec succès.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'status' => 'required|in:available,reserved,maintenance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($vehicle->image_path && file_exists(public_path('pictures/' . $vehicle->image_path))) {
                unlink(public_path('pictures/' . $vehicle->image_path));
            }

            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            
            // Déplacer l'image dans le dossier pictures
            $image->move(public_path('pictures'), $filename);
            
            $validated['image_path'] = $filename;
        }

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->image_path && file_exists(public_path('pictures/' . $vehicle->image_path))) {
            unlink(public_path('pictures/' . $vehicle->image_path));
        }
        
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule supprimé avec succès.');
    }
}
