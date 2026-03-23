<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SymptomRequest;



class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $symptoms = Auth::user()->symptoms()->get();

        // return
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
    public function store(SymptomRequest $request)
    {
        $symptom = Auth::user()->symptoms()->create($request->validated());
    return response()->json(['success'=> true, 'symptom'=> $symptom, 'message'=>'Symptom added'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SymptomRequest $request, Symptom $symptom)
    {
        if ($symptom->user() != Auth::user()) {
        return response()->json([
            'success' => false,
            'message' => 'You are not authorized to edit this symptom',
        ], 403);
        }

        $symptom->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $symptom,
            'message' => 'Symptom updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        //
    }
}
