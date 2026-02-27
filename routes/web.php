<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// If you're using laravel/ui auth scaffolding:
if (class_exists(\Illuminate\Support\Facades\Auth::class)) {
    \Illuminate\Support\Facades\Auth::routes();
}

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/', fn () => redirect()->route('login'))->name('login');
    Route::resource('tasks', TaskController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('/groups/{group}/appointments', AppointmentController::class)->except(['index', 'show']);

    // Groep joinen
    Route::post('groups/join', [GroupController::class, 'join'])->name('groups.join');

    // Afspraak aanmaken binnen groep
    Route::post('/groups/{group}/appointments', [AppointmentController::class, 'store'])
        ->name('appointments.store')
        ->middleware('auth');

    // Afspraak RSVP
    Route::post('/groups/{group}/appointments/{appointment}/rsvp', [AppointmentController::class, 'rsvp'])->name('appointments.rsvp');

});

// Alleen voor admins
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
