<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function (){
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/symptoms', [SymptomController::class, 'index']);
    Route::post('/symptoms', [SymptomController::class, 'store']);
    Route::get('/symptoms/{symptom}', [SymptomController::class, 'show']);
    Route::put('/symptoms/{symptom}', [SymptomController::class, 'update']);
    Route::delete('/symptoms/{symptom}', [SymptomController::class, 'destroy']);

    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::get('/doctors/search', [DoctorController::class, 'search']);
    Route::get('/doctors/{doctor}', [DoctorController::class, 'show']);

    Route::apiResource('appointments', AppointmentController::class);

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
