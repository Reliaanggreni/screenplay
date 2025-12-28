<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeScreenController;
use App\Http\Controllers\RunningTextController;
use Illuminate\Support\Facades\Cache;

Route::get('/', [HomeScreenController::class, 'index'])->name('homescreen');

// auto reload
Route::get('/display/version', function () {
    return response()->json([
        'version' => Cache::rememberForever('display_version', function () {
            return 1;
        }),
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Media Routes
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::get('/create', [MediaController::class, 'create'])->name('create');
        Route::post('/', [MediaController::class, 'store'])->name('store');
        Route::get('/{media}', [MediaController::class, 'show'])->name('show');
        Route::get('/{media}/edit', [MediaController::class, 'edit'])->name('edit');
        Route::put('/{media}', [MediaController::class, 'update'])->name('update');
        Route::delete('/{media}', [MediaController::class, 'destroy'])->name('destroy');

        Route::post('/toggle', [MediaController::class, 'toggle'])
            ->name('toggle');
        Route::post('/urutan', [MediaController::class, 'updateUrutan'])
            ->name('urutan');
        Route::post('/durasi', [MediaController::class, 'updateDurasi'])
            ->name('durasi');
    });

    // Running Text Routes
    Route::prefix('running-texts')->name('running-texts.')->group(function () {
        Route::get('/', [RunningTextController::class, 'index'])->name('index');
        Route::get('/create', [RunningTextController::class, 'create'])->name('create');
        Route::post('/', [RunningTextController::class, 'store'])->name('store');
        Route::get('/{runningText}', [RunningTextController::class, 'show'])->name('show');
        Route::get('/{runningText}/edit', [RunningTextController::class, 'edit'])->name('edit');
        Route::put('/{runningText}', [RunningTextController::class, 'update'])->name('update');
        Route::delete('/{runningText}', [RunningTextController::class, 'destroy'])->name('destroy');
    });

    // agenda route
    Route::prefix('agenda')->name('agenda.')->group(function () {
        Route::get('/', [AgendaController::class, 'index'])->name('index');
        Route::get('/create', [AgendaController::class, 'create'])->name('create');
        Route::post('/', [AgendaController::class, 'store'])->name('store');
        Route::get('/{id_agenda}', [AgendaController::class, 'show'])->name('show');
        Route::get('/{id_agenda}/edit', [AgendaController::class, 'edit'])->name('edit');
        Route::put('/{id_agenda}', [AgendaController::class, 'update'])->name('update');
        Route::delete('/{id_agenda}', [AgendaController::class, 'destroy'])->name('destroy');
    });
});



require __DIR__ . '/auth.php';
