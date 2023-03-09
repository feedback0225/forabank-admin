<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\TypeOfClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkScheduleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');


    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');
});


// Offices
Route::middleware('auth')->prefix('offices')->name('offices.')->group(function () {
    Route::get('/', [OfficeController::class, 'index'])->name('index');
    Route::get('/create', [OfficeController::class, 'create'])->name('create');
    Route::post('/store', [OfficeController::class, 'store'])->name('store');
    Route::get('/edit/{office}', [OfficeController::class, 'edit'])->name('edit');
    Route::put('/update/{office}', [OfficeController::class, 'update'])->name('update');
    Route::delete('/delete/{office}', [OfficeController::class, 'delete'])->name('destroy');

    Route::get('/import-offices', [UserController::class, 'importOffices'])->name('import');
});

// Cities
Route::middleware('auth')->prefix('cities')->name('cities.')->group(function () {
    Route::get('/', [CityController::class, 'index'])->name('index');
    Route::get('/create', [CityController::class, 'create'])->name('create');
    Route::post('/store', [CityController::class, 'store'])->name('store');
    Route::get('/edit/{city}', [CityController::class, 'edit'])->name('edit');
    Route::put('/update/{city}', [CityController::class, 'update'])->name('update');
    Route::delete('/delete/{city}', [CityController::class, 'delete'])->name('destroy');
});

// Work Schedules
Route::middleware('auth')->prefix('work_schedules')->name('work_schedules.')->group(function () {
    Route::get('/', [WorkScheduleController::class, 'index'])->name('index');
    Route::get('/create', [WorkScheduleController::class, 'create'])->name('create');
    Route::post('/store', [WorkScheduleController::class, 'store'])->name('store');
    Route::get('/edit/{workSchedule}', [WorkScheduleController::class, 'edit'])->name('edit');
    Route::put('/update/{workSchedule}', [WorkScheduleController::class, 'update'])->name('update');
    Route::delete('/delete/{workSchedule}', [WorkScheduleController::class, 'delete'])->name('destroy');
});

// Type Of Clients
Route::middleware('auth')->prefix('type_of_clients')->name('type_of_clients.')->group(function () {
    Route::get('/', [TypeOfClientController::class, 'index'])->name('index');
    Route::get('/create', [TypeOfClientController::class, 'create'])->name('create');
    Route::post('/store', [TypeOfClientController::class, 'store'])->name('store');
    Route::get('/edit/{typeOfClient}', [TypeOfClientController::class, 'edit'])->name('edit');
    Route::put('/update/{typeOfClient}', [TypeOfClientController::class, 'update'])->name('update');
    Route::delete('/delete/{typeOfClient}', [TypeOfClientController::class, 'delete'])->name('destroy');
});

// Currencies
Route::middleware('auth')->prefix('currencies')->name('currencies.')->group(function () {
    Route::get('/', [CurrencyController::class, 'index'])->name('index');
    Route::get('/create', [CurrencyController::class, 'create'])->name('create');
    Route::post('/store', [CurrencyController::class, 'store'])->name('store');
    Route::get('/edit/{currency}', [CurrencyController::class, 'edit'])->name('edit');
    Route::put('/update/{currency}', [CurrencyController::class, 'update'])->name('update');
    Route::delete('/delete/{currency}', [CurrencyController::class, 'delete'])->name('destroy');
});



// Blocks

Route::middleware('auth')->prefix('blocks')->name('blocks.')->group(function () {
    Route::get('/', [BlockController::class, 'index'])->name('index');
    Route::delete('/delete/{block}', [BlockController::class, 'delete'])->name('destroy');
});
