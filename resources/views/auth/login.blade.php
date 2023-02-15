<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}" />
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Auth | Login</title>
    </head>
    <body>
        <div class="container">
            <h1><span class="material-icons">public</span>Social <a>Network</a></h1>

            @if (Session::has('error'))
                <div class="error">{{ Session::get('error') }}</div>
            @else
                <div>¡Hey! ¿Another time here?</div>
            @endif

            <form method="POST" class="form" action="{{ route('auth.login') }}">
                @csrf 

                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" readonly onfocus="this.removeAttribute('readonly');">
                <input type="password" placeholder="Password" name="password" readonly onfocus="this.removeAttribute('readonly');">
                <input type="submit" value="Submit">
            </form>

            <div class="register"> 
                <a class="link" href="{{ URL::route('register'); }}">¿Doesn't have an account? Register now</a>
            </div>
        </div>

        <script type="text/javascript" src="{{ URL::asset('js/theme.js') }}"></script>
    </body>

    <style>
        * {
            font-family: 'Nunito', sans-serif; 
            cursor: default; 
            user-select: none; 
        }

        .error {
            color: rgb(228, 78, 78); 
        }

        .container {
            position: absolute; 
            left: 50%; 
            top: 50%; 
            transform: translate(-50%, -50%); 
            display: flex; 
            flex-direction: column; 
            width: 400px; 
        }

        a {
            all: unset;
        }

        h1 a {
            color: var(--app-color); 
        }

        h1 span {
            margin-right: 10px; 
        }

        .register {
            margin-top: 20px; 
            opacity: .6;
            transition: .4s; 
        }

        .register:hover {
            transition: .4s; 
            opacity: 1; 
            cursor: pointer; 
        }
    </style>
</html>