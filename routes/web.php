<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;

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
    return view('welcome');
});

// Route::resource('department',DepartmentController::class);
Route::post('/department', [DepartmentController::class, 'store']);
Route::get('/csrf-token', function() {
    return response()->json(['csrf_token' => csrf_token()]);
});
