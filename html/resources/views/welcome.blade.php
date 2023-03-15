<?php
use App\Models\Audio;
?>
@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-12 w-100 p-3">
        <h1>Large Grid</h1>
        <div class="container-fluid">
            <a href="{{ route('audio.upload') }}">Upload Audio</a>
            @auth

                @foreach(Audio::all() as $audio)
                    <div class="row col-md-12">
                        <div class="col-lg-7 bg-primary text-white">
                            <?=$audio->filename?>
                        </div>
                        <div class=" col-lg-1 bg-dark text-white">
                            <?=$audio->path?>
                        </div>
                        <div class=" col-lg-1 bg-dark text-white">
                            <?=$audio->created_at?>
                        </div>
                    </div>
                @endforeach

            @else
                guest
            @endif
        </div>
    </div>
@endsection
