<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GoalController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // For MVP, auto-login the first user or create one
    $user = User::first() ?? User::create(['name' => 'John Doe', 'email' => 'john@example.com', 'password' => bcrypt('password')]);
    Auth::login($user);
    
    if ($user->financialGoals()->count() == 0) {
        return redirect()->route('onboarding');
    }
    return redirect()->route('dashboard');
});

Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding');
Route::post('/onboarding', [OnboardingController::class, 'store'])->name('onboarding.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('expenses', ExpenseController::class);
Route::resource('goals', GoalController::class);
