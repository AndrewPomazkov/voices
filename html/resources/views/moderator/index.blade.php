@extends('layouts.app')
<?php
/**
 * @property \App\Models\Audio $audio
 */
?>
@section('content')
    <div class="container-fluid mt-12 w-100 p-3">
        <h1>Large Grid</h1>
        <div class="container-fluid">
            @foreach($audios as $audio)
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
                <div class=" col-lg-2 bg-dark text-white">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Edit</button>
                        <a href="/dashboard/audio/<?=$audio->id?>/delete" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
