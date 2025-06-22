<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ObjectUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IdentifiedLogController;
use App\Http\Controllers\ObjectComputerController;
use App\Http\Controllers\ObjectGroupController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/objectusers', [ObjectUserController::class, 'index'])->name('objectusers');
Route::get('/objectusers/search', [ObjectUserController::class, 'search'])->name('objectusers.search');
Route::get('/objectusers/{objectSid}', [ObjectUserController::class, 'show'])->name('objectusers.show');

Route::get('/objectcomputers', [ObjectComputerController::class, 'index'])->name('objectcomputers');
Route::get('/objectcomputers/search', [ObjectComputerController::class, 'search'])->name('objectcomputers.search');
Route::get('/objectcomputers/{objectSid}', [ObjectComputerController::class, 'show'])->name('objectcomputers.show');

Route::get('/objectgroups', [ObjectGroupController::class, 'index'])->name('objectgroups');
Route::get('/objectgroups/search', [ObjectGroupController::class, 'search'])->name('objectgroups.search');
Route::get('/objectgroups/{objectSid}', [ObjectGroupController::class, 'show'])->name('objectgroups.show');

Route::get('/events/users', [EventController::class, 'indexUsers'])->name('events.users.index');
Route::get('/events/users/{userLogId}', [EventController::class, 'showUserEvent'])->name('events.users.show');

Route::get('/events/computers', [EventController::class, 'indexComputers'])->name('events.computers.index');
Route::get('/events/computers/{computerLogId}', [EventController::class, 'showComputerEvent'])->name('events.computers.show');

Route::get('/events/groups', [EventController::class, 'indexGroups'])->name('events.groups.index');
Route::get('/events/groups/{groupLogId}', [EventController::class, 'showGroupEvent'])->name('events.groups.show');
// Route::get('/identifiedlogs', [IdentifiedLogController::class, 'index'])->name('identifiedlogs.index');
// Route::get('/identifiedlogs/{id}', [IdentifiedLogController::class, 'show'])->name('identifiedlogs.show');

require __DIR__.'/auth.php';
