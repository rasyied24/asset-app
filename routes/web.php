<?php

use App\Http\Controllers\ExportAsetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/users/login');
});

Route::get('/users/login', function () {
    return view('users.login');
})->name('login');

Route::post('/users/set-session', function (Request $request) {
    $token = $request->bearerToken(); // Ambil dari Authorization header

    if (!$token) {
        return response()->json(['message' => 'Token missing'], 400);
    }

    // Simpan token ke cookie HttpOnly
    return response()->json(['status' => 'ok'])->cookie(
        'jwt_token', $token, 60, null, null, false, false // last false = HttpOnly = true sebaiknya
    );
});


Route::get('/admin/aset/export/pdf', [ExportAsetController::class, 'export'])->name('aset.export.pdf');

Route::middleware(['user.loggedin'])->group(function () {
    Route::get('/users/dashboard', function () {
        return view('users.assets.dashboard');
    });

    Route::get('/users/assets', function () {
        return view('users.assets.index');
    })->name('users.assets');
});
