<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();

        return response()->json(['success' => true, 'doctors' => $doctors, 'message' => 'Doctors list']);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return response()->json(['success' => true, 'doctor' => $doctor, 'message' => 'Doctor details']);
    }

    public function search(Request $request)
    {
        $query = Doctor::query();
        if($request->special){
            $query->where('specialty', 'like', '%' . $request->special . '%');
        }
        if($request->city){
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $doctors = $query->get();

        return response()->json([
            'success' => true,
            'doctors' => $doctors,
            'message' => 'Search results'   
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
