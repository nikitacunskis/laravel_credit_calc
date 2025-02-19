<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoanController;

Route::get('/', [PageController::class, 'page'])->defaults('page', 'Welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::prefix('api')->group(function () {
    Route::post('/step-{step}/submit', [LoanController::class, 'makeStep']);
});