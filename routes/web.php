<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\TeacherController; 
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\TestController;

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
	// Rutas públicas (sin autenticación)
    Route::get('/csrf-token', function() {
        return response()->json(['csrf_token' => csrf_token()]);
        })->middleware('guest');

    Route::get('/', function () {
    return redirect()->action([LoginController::class, 'show']);
});

Route::get('/students',[StudentController::class, 'getStudents']);
Route::post('/student-code',[StudentController::class, 'getStudentCodeMobile']);
Route::post('/login-mobile',[LoginController::class, 'loginMobile']);

Route::get('/iniciar-sesion', [LoginController::class, 'show'])->name('login')->middleware('guest');
Route::post('/iniciar-sesion', [LoginController::class, 'login'])->name('login.perform')->middleware('guest');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');

Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');

Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

Route::get('/students-by-disability/{id}',[StudentController::class, 'findByDisability']);
Route::get('/students-by-name/{studentName}',[StudentController::class, 'findByNameOrLastname']);
Route::get('/students-by-fullname/{studentName}/{studentLastname}',[StudentController::class, 'findByNameLastname']);

// Rutas de autenticación
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Otras rutas
    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');

    Route::resource('/docentes',TeacherController::class);
    Route::resource('/estudiantes',StudentController::class);
    Route::resource('/practicas',DiagnosticController::class);
    Route::resource('/evaluaciones', TestController::class);

    // Ruta genérica para páginas
    Route::get('/{page}', [PageController::class, 'index'])->name('page');
});