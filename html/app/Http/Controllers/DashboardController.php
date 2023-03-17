<?php

namespace App\Http\Controllers;

use App\Http\Resources\AudioResource;
use App\Models\Audio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $audios = Audio::with('user')->orderBy('created_at', 'desc')->get();

        return view('dashboard.index', [
            'audios' => AudioResource::collection($audios)
        ]);
    }
}
