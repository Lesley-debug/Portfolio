<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/projects/{project}', [PortfolioController::class, 'showProject'])->name('projects.show');
Route::post('/contact', [PortfolioController::class, 'sendMessage'])->name('contact.send');
