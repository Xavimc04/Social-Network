<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}" />
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Auth | Register</title>
    </head>
    <body>
        <div class="container">
            <h1><span class="material-icons">public</span>Social <a>Network</a></h1> 

            @if (Session::has('error'))
                <div class="error">{{ Session::get('error') }}</div>
            @else
                <div>¡Hey! ¿First time here?</div>
            @endif

            <form method="POST" class="form" action="{{ route('auth.register') }}">
                @csrf 

                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" readonly onfocus="this.removeAttribute('readonly');">
                <input type="text" maxlength="20" placeholder="Username" name="username" value="{{ old('username') }}" readonly onfocus="this.removeAttribute('readonly');">
                <input type="password" placeholder="Password" name="password" readonly onfocus="this.removeAttribute('readonly');">
                <input type="password" placeholder="Repeat password" name="repeated" readonly onfocus="this.removeAttribute('readonly');">
                <input type="submit" value="Submit">
            </form>

            <div class="login"> 
                <a class="link" href="{{ URL::route('login'); }}">¿Already have an account? Log in</a>
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

        h1 a { 
            color: var(--app-color); 
        }

        a {
            all: unset;
        }

        h1 span {
            margin-right: 10px; 
        }

        .login {
            margin-top: 20px; 
            opacity: .6;
            transition: .4s; 
        }

        .login:hover {
            transition: .4s; 
            opacity: 1; 
            cursor: pointer; 
        }
    </style>
</html>