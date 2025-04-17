<?php
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-logs', [LogController::class, 'myLogs'])->name('logs.my');
    Route::get('/my-logs/download', [LogController::class, 'downloadMy'])->name('logs.download.my');
    
    // Admin routes
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/logs/create', [LogController::class, 'create'])->name('logs.create');
    Route::post('/logs', [LogController::class, 'store'])->name('logs.store');
    Route::get('/logs/{log}/edit', [LogController::class, 'edit'])->name('logs.edit');
    Route::put('/logs/{log}', [LogController::class, 'update'])->name('logs.update');
    Route::delete('/logs/{log}', [LogController::class, 'destroy'])->name('logs.destroy');
    Route::get('/logs/download', [LogController::class, 'download'])->name('logs.download');
});

require __DIR__.'/auth.php';
