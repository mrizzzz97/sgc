<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', fn () => view('landing'));

// MODULES - LEARNING MANAGEMENT (accessible to murid only)
Route::middleware(['auth', 'role:murid'])->group(function () {
    Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('/modules/{module}', [ModuleController::class, 'show'])->name('modules.show');
    Route::post('/modules/{module}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    
    Route::get('/chapters/{chapter}', [ChapterController::class, 'show'])->name('chapters.show');
    Route::post('/chapters/{chapter}/answer', [ChapterController::class, 'submitAnswer'])->name('chapters.answer');
    
    Route::post('/chapters/{chapter}/comment', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    Route::post('/modules/{module}/certificate', [CertificateController::class, 'generate'])->name('certificates.generate');
    Route::get('/certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
});

// MODULES - GURU DASHBOARD & MANAGEMENT
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/modules', [ModuleController::class, 'teach'])->name('modules.teach');
    Route::get('/modules/{module}/students', [EnrollmentController::class, 'moduleStudents'])->name('enrollments.students');
    Route::get('/modules/{module}/students/{enrollment}', [EnrollmentController::class, 'studentDetail'])->name('enrollments.studentDetail');
    
    // Guru create/edit/delete modules
    Route::get('/guru/modules/create', [ModuleController::class, 'create'])->name('modules.create');
    Route::post('/guru/modules', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('/guru/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::patch('/guru/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('/guru/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');
    
    // Guru manage chapters
    Route::get('/guru/modules/{module}/chapters/create', [ChapterController::class, 'create'])->name('chapters.create');
    Route::post('/guru/modules/{module}/chapters', [ChapterController::class, 'store'])->name('chapters.store');
    Route::get('/guru/chapters/{chapter}/edit', [ChapterController::class, 'edit'])->name('chapters.edit');
    Route::patch('/guru/chapters/{chapter}', [ChapterController::class, 'update'])->name('chapters.update');
    Route::delete('/guru/chapters/{chapter}', [ChapterController::class, 'destroy'])->name('chapters.destroy');
    
    // Guru manage questions
    Route::get('/guru/chapters/{chapter}/questions/create', ['App\\Http\\Controllers\\QuestionController', 'create'])->name('questions.create');
    Route::post('/guru/chapters/{chapter}/questions', ['App\\Http\\Controllers\\QuestionController', 'store'])->name('questions.store');
    Route::get('/guru/questions/{question}/edit', ['App\\Http\\Controllers\\QuestionController', 'edit'])->name('questions.edit');
    Route::patch('/guru/questions/{question}', ['App\\Http\\Controllers\\QuestionController', 'update'])->name('questions.update');
    Route::delete('/guru/questions/{question}', ['App\\Http\\Controllers\\QuestionController', 'destroy'])->name('questions.destroy');
});

// DASHBOARD REDIRECT OTOMATIS BERDASARKAN ROLE
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

// ROLE: MURID
Route::middleware(['auth', 'role:murid'])
    ->get('/murid', fn () => view('dashboard.murid'))
    ->name('murid.dashboard');

// ROLE: GURU
Route::middleware(['auth', 'role:guru'])
    ->get('/guru', fn () => view('dashboard.guru'))
    ->name('guru.dashboard');

// ROLE: ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        $gurus = User::where('role', 'guru')->paginate(10);
        return view('dashboard.admin', compact('gurus'));
    })
        ->name('admin.dashboard');
    
    // Manage Guru
    Route::prefix('admin/guru')->name('guru.')->group(function () {
        Route::get('/', [GuruController::class, 'index'])->name('index');
        Route::get('/create', [GuruController::class, 'create'])->name('create');
        Route::post('/', [GuruController::class, 'store'])->name('store');
        Route::get('/{guru}/edit', [GuruController::class, 'edit'])->name('edit');
        Route::patch('/{guru}', [GuruController::class, 'update'])->name('update');
        Route::delete('/{guru}', [GuruController::class, 'destroy'])->name('destroy');
    });
});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// AUTH (LOGIN, REGISTER, ETC)
require __DIR__.'/auth.php';
