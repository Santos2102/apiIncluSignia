<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;   

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
	Route::get('/department', [DepartmentController::class, 'index'])->middleware('guest');
	Route::get('/csrf-token', function() {
	return response()->json(['csrf_token' => csrf_token()]);
	})->middleware('guest');
	
	Route::get('/', function () {
		return view('welcome');
	});

	Route::post('/login-mobile',[LoginController::class, 'loginMobile'])->middleware('guest');


// Route::resource('department',DepartmentController::class);


	Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/iniciar-sesion', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/iniciar-sesion', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

	//Rutas de Departamentos
	Route::get('/departamentos', [DepartmentController::class, 'listDepartments'])->middleware('auth')->name('listDepartments');
	Route::get('/crear-departamentos', [DepartmentController::class, 'create'])->middleware('auth')->name('createDepartment');
	Route::post('/departmentos/store', [DepartmentController::class, 'store'])->middleware('auth')->name('storeDepartments');
	
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
	Route::group(['middleware' => 'auth'], function () {
		Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
		Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
		Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
		Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
		Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
		Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
		Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
		Route::get('/{page}', [PageController::class, 'index'])->name('page');
		Route::post('logout', [LoginController::class, 'logout'])->name('logout');
		Route::post('/departmentos/store', [DepartmentController::class, 'storeWeb'])->name('saveDepartments');
	});