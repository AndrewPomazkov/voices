<?php

namespace App\Http\Controllers;

use App\Helpers\AudioUploaderHelper;
use App\Http\Resources\AudioResource;
use App\Models\Audio;
use App\Rules\AudioRecording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AudioController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'audio_data' => [
                'required',
                new  AudioRecording(),
            ]
        ]);
        $audio = $request->file('audio_data');
        $extension = AudioUploaderHelper::getExtensionByMimeType($audio);

        $filename = time() . '.' . $extension;
        $path = $audio->storeAs('public/audio', $filename);

        $user = auth()->user();
        $audioMessage = new Audio([
            'filename' => $filename,
            'path' => $path,
            'user_id' => $user->id,
        ]);
        $audioMessage->save();

        // Сохранение аудио эффекта (если есть effect_id)
        $effect_id = $request->input('effect_id');
        $filters = $request->input('filters');

        if ($effect_id && $filters) {
            $audioEffect = new AudioEffects([
                'audio_id' => $audioMessage->id,
                'effect_id' => $effect_id,
                'filters' => $filters,
            ]);

            $audioEffect->save();
        }

        return redirect()->route('dashboard_index');
    }

    public function listen(Request $request, $id)
    {
        $audio = Audio::find($id);

        if (!$audio) {
            return response()->json([
                'message' => 'Audio not found'
            ], 404);
        }

        return response()->json([
            'url' => url('audio/' . $audio->filename)
        ], 200);
    }

    public function showUploadForm()
    {

        $audios = Audio::with('audioEffects')
            ->with('users')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(100)
            ->get();

        return view('audio.upload', [
            'audios' => AudioResource::collection($audios)
        ]);
    }

    public function applyEffect(Request $request, $id)
    {
        // Здесь будет код для применения аудиофильтров
    }
}
