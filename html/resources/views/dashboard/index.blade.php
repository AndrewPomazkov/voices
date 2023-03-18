@extends('layouts.app')

@section('content')
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        canvas {
            display: block;
        }

        #particleCanvas,#canvas-container {
            width: 90%;
            position: absolute;
            left:10%;
            top: 0;
        }
    </style>
    <script>
        var dataJson ='<?=$audios->toJson()?>';
    </script>
    <div id="canvas-container" class="w-full h-full">
        <canvas id="particleCanvas"></canvas>
    </div>

    <script type="module" src="/js/main.js"></script>
@endsection
