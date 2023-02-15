<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}" />
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Network | Main</title>
    </head>
    <body> 
        <div class="middle">
            <section class="header">
                <h1>Welcome back, <span class="color">{{ Auth::user()->name }}</span></h1>
                <h4 style="opacity: .5;">Today you've {{ $posts->count() }} new posts for read...</h4>

                @if (Session::has('success'))
                    <div class="success">{{ Session::get('success') }}</div>
                @else     
                    @if (Session::has('error'))
                        <div class="error">{{ Session::get('error') }}</div>
                    @endif
                @endif

                <div class="bar">
                    <span class="material-icons">search</span>
                    <input class="filter" type="text" name="filter" placeholder="Posts, profiles, categories..."> 
                </div>
            </section>

            <div class="list">
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach
            </div>
        </div>

        <x-blog-create :categories="$categories" />
        <x-bottombar /> 
    </body>

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
            background: var(--input-bg); 
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