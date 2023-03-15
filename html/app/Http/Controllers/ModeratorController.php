<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeratorController extends Controller
{
    public function index()
    {
        // Retrieve all audio messages from the database
        $audios = Audio::all();

        // Retrieve all users from the database
        $users = User::all();

        // Return the view with the audio messages and users
        return view('moderator.index', [
            'audios' => $audios,
            'users' => $users,
        ]);
    }

    public function storeAudio(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'audio' => 'required|mimes:mp3,wav,ogg',
        ]);

        // Store the audio file in the storage directory
        $path = $request->file('audio')->store('audios');

        // Create a new audio message in the database
        $audio = Audio::create([
            'user_id' => Auth::id(),
            'path' => $path,
        ]);

        // Redirect back to the main page for moderators
        return redirect()->route('moderator.index');
    }

    public function deleteAudio($id)
    {
        // Retrieve the audio message from the database
        $audio = Audio::findOrFail($id);

        if (Auth::user()->id !== $audio->user_id && Auth::user()->role !== 'moderator') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // Delete the audio file from the storage directory
        @unlink(storage_path('app/' . $audio->path));

        // Delete the audio message from the database
        $audio->delete();

        // Redirect back to the main page for moderators or Users
        $route = '/' . Auth::user()->role == 'moderator'? 'moderator': 'dashboard';

        return redirect()->to($route);
    }

    public function banUser($id)
    {
        // Retrieve the user from the database
        $user = User::findOrFail($id);

        // Ban the user
        $user->ban();

        // Redirect back to the main page for moderators
        return redirect()->route('moderator.index');
    }

    public function unbanUser($id)
    {
        // Retrieve the user from the database
        $user = User::findOrFail($id);

        // Unban the user
        $user->unban();

        // Redirect back to the main page for moderators
        return redirect()->route('moderator.index');
    }
}
