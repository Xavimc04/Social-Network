<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}" />
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Network | Profile</title>
    </head>

    <body>
        @livewire('profile', [
            "id" => $user->id
        ])

        @livewireScripts 

        <x-blog-create :categories="$categories" />
        <x-bottombar /> 
    </body>

    <style>
        .error {
            color: rgb(224, 82, 82); 
        }

        .profile-edit {
            position: absolute; 
            height: 100%; 
            width: 100%; 
            background: rgba(2, 2, 2, 0.336); 
            z-index: 10; 
            display: none; 
            justify-content: center; 
            align-items: center; 
        } 

        .form {
            background: var(--bg-color); 
            padding: 20px; 
            border-radius: 4px; 
            width: 400px; 
        }

        .back {
            margin-top: 20px; 
            opacity: .5; 
            width: 100%;
            transition: .5s; 
            font-weight: 900; 
        }

        .myself {
            margin-top: 30px; 
            width: 100%; 
            display: flex;   
        }

        .myself button {
            padding: 10px 20px; 
            border: none;  
            border-radius: 4px;  
            background: var(--app-color);  
            transition: .2s; 
            margin-right: 20px;
        }  

        .myself button:hover {
            transform: scale(.90); 
            opacity: .7;
            transition: .2s
        }

        .back:hover {
            opacity: 1;
            transition: .5s; 
            color: var(--app-color); 
            cursor: pointer; 
        }
        
        .header {
            margin-top: 20px; 
        }

        .header div {
            display: flex; 
            flex-direction: row; 
            align-items: center; 
        }

        .header div:not(:first-child) {
            margin-top: 20px; 
        }

        .header div a {
            color: var(--app-color); 
            margin-left: 10px
        }

        .header div span {
            margin-right: 10px; 
            opacity: .7;
        }

        .rounded-image {
            width: 40px; 
            height: 40px; 
            background: var(--app-color);
            color: var(--main-color);  
            margin-right: 20px; 
            border-radius: 50%; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }
    </style>
</html>