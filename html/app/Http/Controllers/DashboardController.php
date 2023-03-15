<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $audios = Audio::with('user')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('dashboard.index', [
            'audios' => $audios
        ]);
    }
}
