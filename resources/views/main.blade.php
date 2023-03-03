<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}" />
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <title>Network | Main</title>

        @livewireStyles 
    </head>

    <body> 
        <div class="middle">
            @livewire('main')
        </div>

        <x-blog-create :categories="$categories" />
        <x-bottombar />
        
        @livewireScripts 
    </body>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> 

    <style> 
        .success {
            margin-bottom: 20px; 
            color: var(--app-color);
        }

        .error {
            margin-bottom: 20px; 
            color: rgb(224, 93, 93); 
        }

        .bar {
            display: flex; 
            width: 100%;
            align-items: center;  
            background: rgba(0, 0, 0, 0.068); 
            padding: 5px 0px; 
            border-radius: 5px; 
        }

        .bar span {
            padding: 0px 15px; 
        }

        .bar input {
            background: none;
            font-family: 'Nunito', sans-serif;  
            border: none; 
            padding: 5px 10px; 
            font-size: 1.1rem; 
            color: var(--input-color);
            width: 350px;  
        }

        .bar input:focus {
            outline: none
        }
    </style>
</html>