<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                position: relative;
                margin: 0;
                padding: 0;
                min-height: 100vh;
            }
            .auth-container {
                position: absolute;
                top: 0;
                right: 0;
                height: 100%;
                min-width: 300px;
                max-width: 25%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 10px;
                background-image: linear-gradient(to right,  rgba(168, 213, 226, 0.7) 100%, rgba(168, 213, 226, 0.7) 40%, rgba(168, 213, 226, 0.7) 0%);

            }
            .auth-container a.btn {
                text-align: center;
                width: 100%;
            }
            .bg-light-blue-200 {
                width: 15%;
                position: fixed;
                top: 0px;
                right: 0px;
                min-height: 100vh;
                background-color: #a8d5e2;
                background-image: linear-gradient(to right,  rgba(168, 213, 226, 0.7) 100%, rgba(168, 213, 226, 0.7) 40%, rgba(168, 213, 226, 0.7) 0%);

            }
            #canvas-container {
                position: absolute;
                top: 0;
                left: 0;
                right: 15%;
                bottom: 0;
                overflow: hidden;
            }
        </style>
    </head>
    <body class="antialiased" >
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="fixed top-0 left-0 w-15 h-screen bg-light-blue-200 px-6 py-4">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        <a href="{{ url('/audio/upload') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Upload audio</a>
                    @else
                        <div class="auth-container">
                            <a href="{{ route('login') }}" class="btn btn-primary text-sm mb-2">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-secondary text-sm">Register</a>
                            @endif
                        </div>
                    @endauth
                </div>
            @endif

            <div class="lg w-100 p-3 " >
                @yield('content')
            </div>
        </div>
    </body>
</html>
