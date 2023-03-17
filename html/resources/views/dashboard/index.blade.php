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
    </style>
    <script>
        var dataJson ='<?=$audios->toJson()?>';
    </script>
    <canvas id="particleCanvas" width="800" height="600"></canvas>

    <script type="module" src="/js/main.js"></script>
@endsection
