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
            <div>¡Hey! ¿First time here?</div>

            @livewire('account.auth.register')

            <div class="login"> 
                <a class="link" href="{{ URL::route('login'); }}">¿Already have an account? Log in</a>
            </div>
        </div>

        @livewireScripts 

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

        .form {
            margin-top: 20px; 
        }

        .form div select { 
            margin-top: 0; 
            width: 49%; 
            font-size: .9rem; 
        }

        .form div {
            display: flex; 
            margin-top: 10px; 
            justify-content: space-between; 
            align-items: center; 
        }

        .form div input[type="date"] {
            width: 49%; 
        }

        .form div label {
            padding-left: 20px; 
        }

        .form div:not(:first-child) {
            margin: 20px 0px; 
        }
    </style>
</html>