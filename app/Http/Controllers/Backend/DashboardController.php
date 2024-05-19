<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\RentCar;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $car = Car::All();
        $user = User::All();
        $rent = RentCar::All();
        return view('backend.dashboard.index', compact('car', 'user', 'rent'));
        
    }

    
}
