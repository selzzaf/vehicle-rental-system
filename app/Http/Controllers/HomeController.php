<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

/**
 * HomeController
 * 
 * Handles the main application routes including the welcome page and dashboard.
 * This controller manages both public and authenticated user views.
 * 
 * @author Your Name
 * @version 1.0
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * Applies authentication middleware to ensure only logged-in users
     * can access the dashboard and other protected routes.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the application dashboard.
     * 
     * This method shows the main dashboard for authenticated users.
     * The dashboard provides an overview of user activities and quick access
     * to key features like reservations and profile management.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display the welcome page with vehicle catalog.
     * 
     * This method is accessible to all users (including guests) and displays
     * the main landing page with a catalog of available vehicles. Vehicles
     * are sorted by creation date (newest first) to showcase the latest additions.
     * 
     * Note: This method bypasses authentication middleware to allow public access.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        // Retrieve all vehicles for the welcome page, ordered by creation date (newest first)
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();

        return view('welcome', compact('vehicles'));
    }
}
