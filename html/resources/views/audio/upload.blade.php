@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="/css/style.css">


    <div id="controls">
        <button id="recordButton">Record</button>
        <button id="pauseButton" disabled>Pause</button>
        <button id="stopButton" disabled>Stop</button>
        @csrf
    </div>
    <div id="formats"></div>
    <ol id="recordingsList"></ol>
    <script src="/js/recorder.js"></script>
    <script src="/js/app.js"></script>

@endsection
