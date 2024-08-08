<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temperature;

class TemperatureController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the most recent 30 temperatures
        $temperatures = Temperature::orderBy('created_at', 'desc')
                                   ->take(30)
                                   ->get();

        // Check if the request is AJAX
        if ($request->ajax()) {
            return response()->json($temperatures);
        }

        // Otherwise, return the view
        return view('temperatures.index', compact('temperatures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'temperature' => 'required|numeric',
            'short_circuit' => 'required|boolean',
        ]);

        Temperature::create([
            'temperature' => $request->temperature,
            'status' => $request->short_circuit,
        ]);

        return response()->json(['message' => true]);
    }
}
