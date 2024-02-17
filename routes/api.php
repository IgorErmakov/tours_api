<?php

//use App\Models\Role;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TravelController;
use App\Models\Permission;
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

Route::get('/', function () {
    return response('API', 200);
});

Route::get('/tour', [TourController::class, 'index'])
    ->name('tour.index');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/travel', [TravelController::class, 'store'])
        ->name('travel.store')
        ->middleware('permission:'.Permission::CREATE_TRAVEL);

    Route::prefix('/tour')->group(function () {
        Route::post('/', [TourController::class, 'store'])
            ->name('tour.store')
            ->middleware('permission:'.Permission::CREATE_TOUR);

        Route::put('/{id}', [TourController::class, 'update'])
            ->name('tour.update')
            ->middleware('permission:'.Permission::EDIT_TOUR);
    });
});
