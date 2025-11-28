<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MuridDashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterPageController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('landing'))->name('home');


/*
|--------------------------------------------------------------------------
| REDIRECT DASHBOARD BERDASARKAN ROLE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        default => redirect()->route('murid.dashboard'),
    };
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| ROUTES MURID
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:murid'])->prefix('murid')->name('murid.')->group(function () {

    // ========== DASHBOARD ==========
    Route::get('/', [MuridDashboardController::class, 'index'])
        ->name('dashboard');

    // ========== TUGAS MURID ==========
    Route::get('/tugas', [MuridDashboardController::class, 'tugas'])
        ->name('tugas');

    // ========== LIST MODUL ==========
    Route::get('/modul', [MuridDashboardController::class, 'modul'])
        ->name('modul');
});


/*
|--------------------------------------------------------------------------
| ROUTES MODUL & CHAPTER (AKSES MURID)
|--------------------------------------------------------------------------
| Route ini tidak memakai prefix 'murid', supaya URL tetap:
|   /modul
|   /modul/{id}
|   /chapter/{id}
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:murid'])->group(function () {

    // ========== MODUL ==========
    Route::get('/modul', [ModuleController::class, 'index'])
        ->name('modules.index');

    Route::get('/modul/{id}', [ModuleController::class, 'show'])
        ->name('modules.show');

    // ========== CHAPTER ==========
    Route::get('/chapter/{id}', [ModuleController::class, 'chapter'])
        ->name('modules.chapter');

    Route::post('/chapter/{id}/complete', [ModuleController::class, 'complete'])
        ->name('modules.chapter.complete');
});



/*
|--------------------------------------------------------------------------
| ROUTE GURU
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

    // Dashboard guru
    Route::get('/', fn () => view('dashboard.guru'))->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | MODUL GURU
    |--------------------------------------------------------------------------
    */
    Route::get('/modul', [ModuleController::class, 'guruIndex'])->name('modul.index');
    Route::get('/modul/create', [ModuleController::class, 'create'])->name('modul.create');
    Route::post('/modul', [ModuleController::class, 'store'])->name('modul.store');

    // ❗ FIX: gunakan {module} agar cocok dengan Module $module
    Route::get('/modul/{module}/edit', [ModuleController::class, 'edit'])->name('modul.edit');
    Route::patch('/modul/{module}', [ModuleController::class, 'update'])->name('modul.update');
    Route::delete('/modul/{module}', [ModuleController::class, 'destroy'])->name('modul.destroy');

    /*
    |--------------------------------------------------------------------------
    | CHAPTER
    |--------------------------------------------------------------------------
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
    |--------------------------------------------------------------------------
    | CHAPTER PAGES (VIDEO + SOAL)
    |--------------------------------------------------------------------------
    */
    Route::get('/chapter/{chapter}/pages', [ChapterPageController::class, 'index'])
        ->name('modul.chapter.pages.index');

    Route::get('/chapter/{chapter}/pages/create', [ChapterPageController::class, 'create'])
        ->name('modul.chapter.pages.create');

    Route::post('/chapter/{chapter}/pages', [ChapterPageController::class, 'store'])
        ->name('modul.chapter.pages.store');

    /*
    |--------------------------------------------------------------------------
    | PROFIL GURU
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', fn () => view('guru.profile'))->name('profile');
    Route::get('/profile/edit', fn () => view('guru.profile-edit'))->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // LIST PAGE
    Route::get('/chapter/{chapter}/pages', [ChapterPageController::class, 'index'])
        ->name('modul.chapter.pages.index');

    // CREATE PAGE
    Route::get('/chapter/{chapter}/pages/create', [ChapterPageController::class, 'create'])
        ->name('modul.chapter.pages.create');

    Route::post('/chapter/{chapter}/pages', [ChapterPageController::class, 'store'])
        ->name('modul.chapter.pages.store');

    // EDIT PAGE
    Route::get('/chapter/{chapter}/pages/{page}/edit', [ChapterPageController::class, 'edit'])
        ->name('modul.chapter.pages.edit');

    // UPDATE PAGE
    Route::patch('/chapter/{chapter}/pages/{page}', [ChapterPageController::class, 'update'])
        ->name('modul.chapter.pages.update');

    // DELETE PAGE
    Route::delete('/chapter/{chapter}/pages/{page}', [ChapterPageController::class, 'destroy'])
        ->name('modul.chapter.pages.delete');

});


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/', [GuruController::class, 'index'])->name('admin.dashboard');

    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::patch('/guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');
});


/*
|--------------------------------------------------------------------------
| PROFILE GLOBAL
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
