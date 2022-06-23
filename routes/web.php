<?php

use App\Http\Controllers\AnimesController;
use App\Http\Controllers\ControlPanel;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Showing Home page
Route::get('/', [AnimesController::class, 'animes']);

// Showing Single Anime page
Route::get('/anime', [AnimesController::class, 'anime']);

// Showing LogIn page
Route::get('/login', [UserController::class, 'login']);

// Showing Register page
Route::get('/register', [UserController::class, 'register']);

// CONTROL PANEL AUTHENTICATION SYSTEM      
Route::get('/controlpanel', [ControlPanel::class, 'login'])->name('login')->middleware('guest');
Route::post('/controlpanel/login/authenticate', [ControlPanel::class, 'authenticate'])->middleware('guest');
Route::post('/controlpanel/logout', [ControlPanel::class, 'logout'])->middleware('auth');

// Showing CONTROL PANEL home page
Route::get('/controlpanel/home', [ControlPanel::class, 'home'])->middleware('auth');

// Showing CONTROL PANEL animes page
Route::get('/controlpanel/animes', [ControlPanel::class, 'animes'])->middleware('auth');

// Showing CONTROL PANEL new anime page
Route::get('/controlpanel/animes/new', [ControlPanel::class, 'newAnime'])->middleware('auth');

// Showing CONTROL PANEL edit anime page
Route::get('/controlpanel/animes/anime/edit', [ControlPanel::class, 'editAnime'])->middleware('auth');