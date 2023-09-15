<?php

use App\Http\Controllers\ApartementController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;


//.. Other routes

Auth::routes();


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','admin'])->group(function () {
    // Routes that require admin access
    
    // ... other routes
    Route::resource('users', UserController::class);
    Route::get('residences/{residence_id}/apartments', 'ApartementController@index')->name('apartments.index.by_residence');
    Route::get('/dashboard', [ResidenceController::class, 'countResidencesAndApartments'])->name('dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('residences', ResidenceController::class);
    Route::resource('apartments', ApartementController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('reserved', ReservedController::class);
    // Route order 
Route::get('orders/{residence_id}/apartments', 'ApartementController@index')->name('apartments.index.by_residence');
Route::get('/orders/create/{apartment_id}', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::get('/notifications', function () {
    $notifications = auth()->user()->unreadNotifications;

    return view('notifications', compact('notifications'));
});
Route::post('/notifications/mark-as-read/{notification}', [NotificationController::class,'markAsRead'])->name('notifications.markAsRead');


});






