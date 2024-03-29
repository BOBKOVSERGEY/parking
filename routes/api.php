<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\PasswordUpdateController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\ParkingController;
use App\Http\Controllers\Api\V1\VehicleController;
use App\Http\Controllers\Api\V1\ZoneController;
use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::prefix('v1')
    ->group(function () {
        Route::post('auth/register', RegisterController::class);
        Route::post('auth/login', LoginController::class);
        Route::get('zones', [ZoneController::class, 'index']);
    });


Route::prefix('v1')
    ->middleware('auth:sanctum')->group(function() {

    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::put('password', PasswordUpdateController::class);
    Route::post('auth/logout', LogoutController::class);

    Route::apiResource('vehicles', VehicleController::class);
        Route::get('parkings', [ParkingController::class, 'index']);
        Route::get('parkings/history', [ParkingController::class, 'history']);

    Route::post('parking/start', [ParkingController::class, 'start']);

        Route::bind('activeParking', function ($id) {
            return Parking::where('id', $id)->active()->firstOrFail();
        });

    Route::get('parking/{parking}', [ParkingController::class, 'show']);
    Route::put('parking/{parking}', [ParkingController::class, 'stop']);
});
