<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AllergenController;

// Landing page
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);

// Signup
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'processSignup']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin user management
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');

    // Admin view feedback
    Route::get('/admin/feedback', [FeedbackController::class, 'viewFeedback'])->name('admin.feedback');

    // Allow admin to view the user dashboard
    Route::get('/dashboard', function () {
        return view('dashboard'); // Render the dashboard view for admin
    })->name('dashboard');
});

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Allergen management
    Route::get('/profile/allergens/suggestions', [ProfileController::class, 'allergenSuggestions']);
    Route::post('/profile/allergens', [ProfileController::class, 'storeAllergen'])->name('profile.allergens.store');
    Route::delete('/profile/allergens/{id}', [ProfileController::class, 'deleteAllergen'])->name('profile.allergens.delete');
    Route::get('/profile/allergens/{id}/edit', [ProfileController::class, 'editAllergen'])->name('profile.allergens.edit');
    Route::patch('/profile/allergens/{id}/update', [ProfileController::class, 'updateAllergen'])->name('profile.allergens.update');

    Route::get('/api/allergens/suggestions', function (Request $request) {
        $query = $request->get('query');
        $fruits = \App\Models\Fruit::where('name', 'like', "%{$query}%")->get();
        $vegetables = \App\Models\Vegetable::where('name', 'like', "%{$query}%")->get();
    
        return response()->json($fruits->merge($vegetables));
    });
    

    // Image upload
    Route::get('/upload-image', [UploadController::class, 'showUploadForm'])->name('upload.image.form');
    Route::post('/upload-image', [UploadController::class, 'uploadImage'])->name('upload.image');
});

// Feedback submission (accessible to all authenticated users)
Route::post('/feedback/submit', [FeedbackController::class, 'submitFeedback'])->name('user.feedback.submit');

// History
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::middleware('auth')->group(function () {
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');
});

// Include the default auth routes
require __DIR__ . '/auth.php';
