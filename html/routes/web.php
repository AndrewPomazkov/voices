<?php

use App\Http\Controllers\AudioEffectsController;
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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/login', function () {
    return view('auth.loginForm');
})->name('login');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [RegistrationControllerAlias::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegistrationControllerAlias::class, 'store']);

Route::get('home', [DashboardController::class, 'index']);

Route::middleware('auth')->group(function () {

    Route::post('/audio/effect/bitcrusher', [AudioEffectsController::class, 'storeBitcrusher'])->name('audio_effect_bitcrusher');
    Route::post('/audio/effect/chorus', [AudioEffectsController::class, 'storeChorus'])->name('audio_effect_chorus');
    Route::post('/audio/effect/compression', [AudioEffectsController::class, 'storeCompression'])->name('audio_effect_compression');
    Route::post('/audio/effect/equalizer', [AudioEffectsController::class, 'storeEqualizer'])->name('audio_effect_equalizer');
    Route::post('/audio/effect/echo', [AudioEffectsController::class, 'storeEcho'])->name('audio_effect_echo');
    Route::post('/audio/effect/flanger', [AudioEffectsController::class, 'storeFlanger'])->name('audio_effect_flanger');
    Route::post('/audio/effect/gain', [AudioEffectsController::class, 'storeGain'])->name('audio_effect_gain');
    Route::post('/audio/effect/limiter', [AudioEffectsController::class, 'storeLimiter'])->name('audio_effect_limiter');
    Route::post('/audio/effect/norm', [AudioEffectsController::class, 'storeNorm'])->name('audio_effect_norm');
    Route::post('/audio/effect/overdrive', [AudioEffectsController::class, 'storeOverdrive'])->name('audio_effect_overdrive');
    Route::post('/audio/effect/phaser', [AudioEffectsController::class, 'storePhaser'])->name('audio_effect_phaser');
    Route::post('/audio/effect/pitch', [AudioEffectsController::class, 'storePitch'])->name('audio_effect_pitch');
    Route::post('/audio/effect/reverb', [AudioEffectsController::class, 'storeReverb'])->name('audio_effect_reverb');
    Route::post('/audio/effect/silence', [AudioEffectsController::class, 'storeSilence'])->name('audio_effect_silence');
    Route::post('/audio/effect/speed', [AudioEffectsController::class, 'storeSpeed'])->name('audio_effect_speed');
    Route::post('/audio/effect/stat', [AudioEffectsController::class, 'storeStat'])->name('audio_effect_stat');
    Route::post('/audio/effect/synth', [AudioEffectsController::class, 'storeSynth'])->name('audio_effect_synth');
    Route::post('/audio/effect/tempo', [AudioEffectsController::class, 'storeTempo'])->name('audio_effect_tempo');
    Route::post('/audio/effect/timescale', [AudioEffectsController::class, 'storeTimeScale'])->name('audio_effect_timescale');
    Route::post('/audio/effect/tremolo', [AudioEffectsController::class, 'storeTremolo'])->name('audio_effect_tremolo');
    Route::post('/audio/effect/trim', [AudioEffectsController::class, 'storeTrim'])->name('audio_effect_trim');
    Route::post('/audio/effect/vad', [AudioEffectsController::class, 'storeVad'])->name('audio_effect_vad');
    Route::post('/audio/effect/vol', [AudioEffectsController::class, 'storeVol'])->name('audio_effect_vol');


    Route::post('audio/effect/list', [AudioEffectsController::class, 'list'])->name('audio.effect.list');

    Route::post('audio/{id}/apply-effect', [AudioController::class, 'applyEffect'])->name('audio.apply_effect');

    Route::get('audio/upload', [AudioController::class, 'showUploadForm'])->name('audio.upload');
    Route::post('audio/store', [AudioController::class, 'store'])->name('audio.store');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard_index');
    Route::get('dashboard/audio/{id}/delete', [ModeratorController::class, 'deleteAudio'])->name('dashboard_delete_audio');

    Route::get('moderator', [ModeratorController::class, 'index'])->name('moderator.index');
    Route::post('moderator/audio', [ModeratorController::class, 'storeAudio'])->name('moderator.store.audio');
    Route::get('moderator/audio/{id}/delete', [ModeratorController::class, 'deleteAudio'])->name('moderator.delete.audio');
    Route::post('moderator/user/ban/{id}', [ModeratorController::class, 'banUser'])->name('moderator.ban.user');
    Route::delete('moderator/user/unban/{id}', [ModeratorController::class, 'unbanUser'])->name('moderator.unban.user');
});
