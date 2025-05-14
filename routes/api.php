<?php

use App\Http\Controllers\API\AssetController;
use App\Http\Controllers\API\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/assets/generate-code', [AssetController::class, 'generateCode']);
    Route::get('/assets/filter', [AssetController::class, 'index']);
    Route::apiResource('assets', AssetController::class);
});
