<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>           
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-size: cover;
                background-image:url("../images/in-vitro-fecundacion.jpg");
            }

            .tituloPortada {
                font-family:Arial;
                font-size:40px;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-3"><span class="tituloPortada">UMR</span></div>
                <div class="col-sm-6"></div>
                <div class="col-sm-3">
            @if (Route::has('login'))
                <div class="mt-4">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" style="text-decoration:none;color:yellow">Log in</a>
<!--
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>                            
                        @endif
        -->                        
                    @endauth
                </div>
            @endif            
                </div>
            </div>
        </div>
    </body>
</html>
