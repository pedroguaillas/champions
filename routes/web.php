<?php

use App\Http\Controllers\PlayerController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Game;
use App\Http\Livewire\ListGames;
use App\Http\Livewire\ListSanctions;
use App\Http\Livewire\ListTeams;
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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', Dashboard::class);
    Route::get('clubes', ListTeams::class);
    Route::get('club/{team_id}/jugadores', [PlayerController::class, 'index'])->name('jugadores');
    Route::get('partidos', ListGames::class);
    Route::get('partido/{game_id}', Game::class)->name('partido');
    Route::get('sanciones', ListSanctions::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
