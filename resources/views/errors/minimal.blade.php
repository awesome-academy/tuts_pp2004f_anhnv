<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
            }

            li {
                list-style: none;
            }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                flex-direction: column;
            }

            .position-ref {
                position: relative;
            }

            .status {
                display: flex;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
                display: inline-block;
            }
            
            .quick-menu {
                display: block;
                width: 100%;
                text-align: center;
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="status">
                <div class="code">
                    @yield('code')
                </div>
    
                <div class="message" style="padding: 10px;">
                    @yield('message')
                </div>
            </div>

            @section('content')
                <ul class="quick-menu">
                    <li><a href="{{ url('/') }}">Back to Home</a></li>
                </ul>
            @show
        </div>
    </body>
</html>
