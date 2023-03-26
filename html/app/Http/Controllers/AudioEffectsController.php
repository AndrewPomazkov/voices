<?php

namespace App\Http\Controllers;

use App\Models\Effect;
use App\Rules\{
    BitcrusherRule,
    ChorusRule,
    CompressionRule,
    EchoRule,
    EqualizerRule,
    FlangerRule,
    GainRule,
    LimiterRule,
    NormRule,
    OverdriveRule,
    PhaserRule,
    PitchRule,
    ReverbRule,
    SilenceRule,
    SpeedRule,
    StatRule,
    SynthRule,
    TempoRule,
    TimeScaleRule,
    TremoloRule,
    TrimRule,
    VadRule,
    VolRule
};

use Illuminate\Http\Request;

class AudioEffectsController extends Controller
{
    public function storeVad(Request $request)
    {
        $request->validate([
            'timescale_params' => ['required', new VadRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeVol(Request $request)
    {
        $request->validate([
            'timescale_params' => ['required', new VolRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeTrim(Request $request)
    {
        $request->validate([
            'timescale_params' => ['required', new TrimRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeTimeScale(Request $request)
    {
        $request->validate([
            'timescale_params' => ['required', new TimeScaleRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeStat(Request $request)
    {
        $request->validate([
            'stat_params' => ['required', new StatRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeSilence(Request $request)
    {
        $request->validate([
            'silence_params' => ['required', new SilenceRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeSynth(Request $request)
    {
        $request->validate([
            'synth_params' => ['required', new SynthRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeTremolo(Request $request)
    {
        $request->validate([
            'tremolo_params' => ['required', new TremoloRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeSpeed(Request $request)
    {
        $request->validate([
            'speed_params' => ['required', new SpeedRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeReverb(Request $request)
    {
        $request->validate([
            'reverb_params' => ['required', new ReverbRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storePitch(Request $request)
    {
        $request->validate([
            'pitch_params' => ['required', new PitchRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeOverdrive(Request $request)
    {
        $request->validate([
            'overdrive_params' => ['required', new OverdriveRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeNorm(Request $request)
    {
        $request->validate([
            'norm_params' => ['required', new NormRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeLimiter(Request $request)
    {
        $request->validate([
            'limiter_params' => ['required', new LimiterRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeGain(Request $request)
    {
        $request->validate([
            'gain_params' => ['required', new GainRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeFlanger(Request $request)
    {
        $request->validate([
            'flanger_params' => ['required', new FlangerRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeEqualizer(Request $request)
    {
        $request->validate([
            'equalizer_params' => ['required', new EqualizerRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeEcho(Request $request)
    {
        $request->validate([
            'echo_params' => ['required', new EchoRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeBitcrusher(Request $request)
    {
        $request->validate([
            'bitcrusher_params' => ['required', new BitcrusherRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeChorus(Request $request)
    {
        $request->validate([
            'chorus_params' => ['required', new ChorusRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeCompression(Request $request)
    {
        $request->validate([
            'compression_params' => ['required', new CompressionRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storePhaser(Request $request)
    {
        $request->validate([
            'phaser_params' => ['required', new PhaserRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function storeTempo(Request $request)
    {
        $request->validate([
            'tempo_param' => ['required', new TempoRule()],
        ]);

        // Ваш код для обработки запроса
    }

    public function list()
    {
        return response()->json([
            'effects' => Effect::all()
        ], 200);
    }
}
