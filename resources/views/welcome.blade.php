<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                background-image: url('/imagens/Fundo.png');
                background-repeat: no-repeat;
                background-attachment: fixed;
                /*background-position: center; */
                color: #050E59;
                font-family: 'Nunito', sans-serif;

                font-weight: 200;
                background-size:100%;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: left;
                display: flex;
                justify-content: center;
                top: 25px;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                /*position: absolute;*/
                /*right: 10px;*/
                /*top: 1px;*/
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 64px;
            }

            .links > a {
                color: #050E59;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                /* margin-bottom: 1px; */
                margin-top: 1%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    <img src="/imagens/inri.png" width='20%'/>
                </div>
                <h2>Sistema de supervisão e controle de temperatura e umidade </h2>
                 @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">REGISTRAR</a>
                        @endif
                    @endauth
                </div>
            @endif
            </div>
        </div>
    </body>
</html>
