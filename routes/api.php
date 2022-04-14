<?php

use App\Http\Controllers\API\v1\CarsController;
use App\Http\Controllers\API\v1\MechanicsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    // Cars
    Route::controller(CarsController::class)->group(function () {
        Route::get('/cars', 'index');
    });

    // Mechanics
    Route::controller(MechanicsController::class)->group(function () {
        Route::get('/mechanics', 'index');
        Route::get('/mechanics/{mechanic}', 'show');
        Route::post('/mechanics', 'store');
    });

    Route::get('/test', function () {
        $data = collect(['Tom', 'John', 'James', null, 0])
            ->map(function ($element) {
                return strtoupper($element);
            })
            ->reject(function ($element) {
                return empty($element);
            });

        return response()->json($data);
    });
});
