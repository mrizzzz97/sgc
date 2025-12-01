<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MuridDashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\MuridController;
use App\Http\Controllers\Admin\AdminStatistikController;

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterPageController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('landing'))->name('home');

/*
|--------------------------------------------------------------------------
| REDIRECT DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])
    ->get('/dashboard', function () {

        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru'  => redirect()->route('guru.dashboard'),
            default => redirect()->route('murid.dashboard'),
        };
    })
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| ========================== ROUTE MURID ==========================
|--------------------------------------------------------------------------
|
| Semua route murid dikumpulkan di sini. Perhatikan:
| - route untuk "masuk ke chapter (redirect ke page 1)" diberi nama modules.chapter
|   tetapi path-nya dibuat berbeda (/modul/chapter/{id}) supaya tidak bentrok dengan
|   route lain yang menggunakan /chapter/{...}
|
*/
Route::middleware(['auth', 'role:murid'])
    ->prefix('murid')
    ->name('murid.')
    ->group(function () {

        // Dashboard utama murid
        Route::get('/', [MuridDashboardController::class, 'index'])->name('dashboard');

        Route::get('/tugas', [MuridDashboardController::class, 'tugas'])->name('tugas');

        // List modul
        Route::get('/modul', [MuridDashboardController::class, 'modul'])->name('modul');

        // Detail modul (menampilkan daftar chapter)
        Route::get('/modul/{id}', [ModuleController::class, 'show'])->name('modules.show');

        // Masuk ke chapter → tampilkan page ke-1 (NAMED route: modules.chapter)
        // NOTE: path sengaja /modul/chapter/{id} untuk menghindari collision dengan /chapter/{...}
        Route::get('/modul/chapter/{id}', [ModuleController::class, 'chapter'])
            ->name('modules.chapter');

        // Halaman modul per page
        Route::get('/chapter/{chapter}/{page}', [ModuleController::class, 'page'])
            ->name('modules.page');

        // Selesaikan halaman
        Route::post('/chapter/{chapter}/{page}/complete', [ModuleController::class, 'complete'])
            ->name('modules.page.complete');

        // Komentar modul
        Route::post('/modul/{id}/comment', [ModuleController::class, 'addComment'])
            ->name('modules.comment');

        Route::delete('/modul/comment/{id}', [ModuleController::class, 'deleteComment'])
            ->name('modules.comment.delete');

        // Chapter selesai — tetap pakai /chapter/{chapter}/finish (tidak bentrok karena modules.chapter berbeda)
        Route::get('/chapter/{chapter}/finish', [ModuleController::class, 'chapterFinish'])
            ->whereNumber('chapter')
            ->name('chapter.finish');

        // Hasil & sertifikat
        Route::get('/modul/{id}/hasil', [ModuleController::class, 'result'])
            ->name('modules.result');

        Route::get('/modul/{id}/sertifikat', [ModuleController::class, 'certificate'])
            ->name('modules.certificate');
    });

/*
|--------------------------------------------------------------------------
| ========================== ROUTE GURU ==========================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        // Dashboard guru
        Route::get('/', fn () => view('dashboard.guru'))->name('dashboard');

        // Profile guru (punya sendiri)
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');

        /*
        | MODULE CRUD
        */
        Route::get('/modul', [ModuleController::class, 'guruIndex'])->name('modul.index');
        Route::get('/modul/create', [ModuleController::class, 'create'])->name('modul.create');
        Route::post('/modul', [ModuleController::class, 'store'])->name('modul.store');

        Route::get('/modul/{module}/edit', [ModuleController::class, 'edit'])->name('modul.edit');
        Route::patch('/modul/{module}', [ModuleController::class, 'update'])->name('modul.update');
        Route::delete('/modul/{module}', [ModuleController::class, 'destroy'])->name('modul.destroy');

        /*
        | CHAPTER CRUD
        */
        Route::get('/modul/{module}/chapter', [ChapterController::class, 'index'])
            ->name('modul.chapter.index');

        Route::get('/modul/{module}/chapter/create', [ChapterController::class, 'create'])
            ->name('modul.chapter.create');

        Route::post('/modul/{module}/chapter/store', [ChapterController::class, 'store'])
            ->name('modul.chapter.store');

        Route::get('/chapter/{chapter}/edit', [ChapterController::class, 'edit'])
            ->name('modul.chapter.edit');

        Route::patch('/chapter/{chapter}/update', [ChapterController::class, 'update'])
            ->name('modul.chapter.update');

        Route::delete('/chapter/{chapter}/delete', [ChapterController::class, 'destroy'])
            ->name('modul.chapter.delete');

        /*
        | PAGE CRUD
        */
        Route::get('/chapter/{chapter}/pages', [ChapterPageController::class, 'index'])
            ->name('modul.chapter.pages.index');

        Route::get('/chapter/{chapter}/pages/create', [ChapterPageController::class, 'create'])
            ->name('modul.chapter.pages.create');

        Route::post('/chapter/{chapter}/pages', [ChapterPageController::class, 'store'])
            ->name('modul.chapter.pages.store');

        Route::get('/chapter/{chapter}/pages/{page}/edit', [ChapterPageController::class, 'edit'])
            ->name('modul.chapter.pages.edit');

        Route::patch('/chapter/{chapter}/pages/{page}', [ChapterPageController::class, 'update'])
            ->name('modul.chapter.pages.update');

        Route::delete('/chapter/{chapter}/pages/{page}', [ChapterPageController::class, 'destroy'])
            ->name('modul.chapter.pages.delete');
    });

/*
|--------------------------------------------------------------------------
| ========================== ROUTE ADMIN ==========================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Statistik admin
        Route::get('/statistik', [AdminStatistikController::class, 'index'])->name('statistik');

        // Dashboard admin
        Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

        /*
        | GURU MANAGEMENT
        */
        Route::prefix('guru')->name('guru.')->group(function () {

            Route::get('/', [GuruController::class, 'index'])->name('index');
            Route::get('/create', [GuruController::class, 'create'])->name('create');
            Route::post('/', [GuruController::class, 'store'])->name('store');

            Route::get('/{guru}/edit', [GuruController::class, 'edit'])->name('edit');
            Route::patch('/{guru}', [GuruController::class, 'update'])->name('update');

            Route::put('/{guru}/password', [GuruController::class, 'updatePassword'])
                ->name('password.update');

            Route::delete('/{guru}', [GuruController::class, 'destroy'])->name('destroy');
        });

        /*
        | MURID MANAGEMENT
        */
        Route::prefix('murid')->name('murid.')->group(function () {

            Route::get('/', [MuridController::class, 'index'])->name('index');

            Route::get('/create', [MuridController::class, 'create'])->name('create');
            Route::post('/', [MuridController::class, 'store'])->name('store');

            Route::get('/{murid}/edit', [MuridController::class, 'edit'])->name('edit');
            Route::patch('/{murid}', [MuridController::class, 'update'])->name('update');

            Route::put('/{murid}/password', [MuridController::class, 'updatePassword'])
                ->name('password.update');

            Route::delete('/{murid}', [MuridController::class, 'destroy'])->name('destroy');
        });

    });

/*
|--------------------------------------------------------------------------
| PROFILE GLOBAL (Semua Role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| CHECK LOGIN (debug helper)
|--------------------------------------------------------------------------
*/
Route::get('/check-login', function () {
    return [
        'user' => Auth::user(),
        'role' => Auth::user()?->role
    ];
});

require __DIR__.'/auth.php';
