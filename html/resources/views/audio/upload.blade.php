@extends('layouts.app')

@section('content')
    <?php
    /**
     * @props Audio $audios;
     */
    ?><link rel="stylesheet" type="text/css" href="/css/style.css">
    <div class="container mt-3">
        <h2>List Audios</h2>
        @foreach($audios as $audio)
            <?php
            //dd([$audio->images(), $audio]);
            ?>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?=$audio->filename?>
                    <span class="badge bg-primary rounded-pill">12</span>
                </li>
            </ul>
        @endforeach
    </div>
    <div>
        <label for="effect_id">Effect:</label>
        <select id="effect_id">
            <option value="">None</option>
            <option value="1">Effect 1</option>
            <option value="2">Effect 2</option>
        </select>
    </div>
    <div>
        <label for="filters">Filters:</label>
        <input type="text" id="filters" placeholder="Enter filters as JSON">
    </div>
    <div id="controls">
        <button id="recordButton">Record</button>
        <button id="pauseButton" disabled>Pause</button>
        <button id="stopButton" disabled>Stop</button>
    </div>
    <div id="formats"></div>
    <ol id="recordingsList"></ol>
    <script src="/js/recorder.js"></script>
    <script src="/js/app.js"></script>

@endsection
