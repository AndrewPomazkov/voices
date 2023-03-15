<?php

use App\Http\Controllers\RegistrationController as RegistrationControllerAlias;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AudioController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('auth.loginForm');
})->name('login');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [RegistrationControllerAlias::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegistrationControllerAlias::class, 'store']);

Route::get('home', [DashboardController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('audio/upload', [AudioController::class, 'showUploadForm'])->name('audio.upload');
    Route::post('audio/upload', [AudioController::class, 'store'])->name('audio.store');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard_index');
    Route::get('dashboard/audio/{id}/delete', [ModeratorController::class, 'deleteAudio'])->name('dashboard_delete_audio');


    Route::get('moderator', [ModeratorController::class, 'index'])->name('moderator.index');
    Route::post('moderator/audio', [ModeratorController::class, 'storeAudio'])->name('moderator.store.audio');
    Route::get('moderator/audio/{id}/delete', [ModeratorController::class, 'deleteAudio'])->name('moderator.delete.audio');
    Route::post('moderator/user/ban/{id}', [ModeratorController::class, 'banUser'])->name('moderator.ban.user');
    Route::delete('moderator/user/unban/{id}', [ModeratorController::class, 'unbanUser'])->name('moderator.unban.user');
});
