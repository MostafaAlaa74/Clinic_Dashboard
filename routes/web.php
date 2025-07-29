<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ChangeStatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetNotificationController;
use App\Http\Controllers\MonthlyRevenueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckPremmision;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});





// Monthly Revenue Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
    Route::get('/dayappointemnts' , [AppointmentController::class , 'GetTodayAppointments']) ->name('dayappointment.index');
    Route::resource('reports', ReportController::class);
    Route::post('/appointments/{id}', [ChangeStatusController::class, 'ChangeStatus'])
        ->name('appointments.changeStatus');
    Route::get('/dashboard', [DashboardController::class, 'GetPatientNumbers'])
        ->middleware(CheckPremmision::class)
        ->name('dashboard');
    Route::get('/patients', [UserController::class, 'GetAllPatient'])->name('patients.index');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notification Routes
    Route::get('/notifications', [GetNotificationController::class, 'GetNotification'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [GetNotificationController::class, 'MarkAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/unread-count', [GetNotificationController::class, 'GetUnreadCount'])->name('notifications.unreadCount');
    Route::get('/notifications/unread', [GetNotificationController::class, 'GetUnreadNotifications'])->name('notifications.unread');
});

require __DIR__ . '/auth.php';
