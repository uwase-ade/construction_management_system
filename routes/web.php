<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['guest', 'no.cache'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth', 'no.cache'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class);
    Route::get('projects/{project}/progress', [ProjectController::class, 'progress'])->name('projects.progress');
    Route::put('projects/{project}/progress', [ProjectController::class, 'updateProgress'])->name('projects.progress.update');

    Route::resource('workers', WorkerController::class)->except(['show']);
    Route::resource('materials', MaterialController::class)->except(['show']);
    Route::resource('assignments', AssignmentController::class)->except(['show']);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{project}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{project}/print', [ReportController::class, 'print'])->name('reports.print');
});
