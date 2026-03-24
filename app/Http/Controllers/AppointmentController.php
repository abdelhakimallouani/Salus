<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Auth::user()->appointments()->with('doctor')->get();

        return response()->json(['success' => true, 'appointments' => $appointments, 'message' => 'My appointments']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
    $appointment = Auth::user()->appointments()->create($request->validated());

        return response()->json(['success' => true, 'appointment' => $appointment, 'message' => 'Appointment created'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        if ($appointment->user_id != Auth::id()) {
            return response()->json([
            'success' => false,
            'message' => 'Unauthorized',
            ], 403);

        }
        
        return response()->json([
            'success'=>true,
            'appointment'=> $appointment->load('doctor'),
            'message'=>'Appointment details'
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        if ($appointment->user_id != Auth::id()) {
            return response()->json([
            'success' => false,
            'message' => 'Unauthorized',
            ], 403);

        }

        $appointment->update($request->validated());
        return response()->json([
            'success' => true,
            'data' => $appointment,
            'message' => 'Appointment updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id != Auth::id()) {
            return response()->json([
            'success' => false,
            'message' => 'Unauthorized',
            ], 403);

        }

        $appointment->update(['status' => 'cancelled']);

        return response()->json([
            'success' => true,
            'data' => $appointment,
            'message' => 'Appointment cancelled'
        ]);
        
    }
}
