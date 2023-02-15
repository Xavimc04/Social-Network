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
        <div class="middle">
            <div class="material-icons back" onclick="window.location.href = '/'">arrow_back</div>

            <div class="header">
                <div>
                    @if ($user->profile_route != null)
                        <div>Tienes imagen</div>
                    @else
                        <div class="rounded-image">{{ $user->name[0] }}</div>
                    @endif

                    {{ $user->name }}
                </div>

                <div><span class="material-icons">celebration</span> Member since:  <a>{{ $user->created_at }}</a></div>
                <div><span class="material-icons">post_add</span> Posts: <a>{{ $posts->count() }}</a></div>
                <div><span class="material-icons">contacts</span> Followers: <a>Undefined</a></div>
                <div><span class="material-icons">verified</span> Status: <a>{{ $user->is_admin ? 'Administrator' : 'User' }}</a></div>
                <div><span class="material-icons">fact_check</span> Following/unfollowing</div>
            </div>

            @if (Auth::user()->name == $user->name)
                <div class="myself">
                    <button onclick="handleCreator()" title="Create new post">New post</button>
                    <button>Change picture</button>
                    <button>Change name</button>
                </div>
            @endif

            <div class="posts">
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach
            </div>
        </div>

        <x-blog-create :categories="$categories" />
        <x-bottombar /> 
    </body>

    <style>
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
            justify-content: space-between; 
        }

        .myself button {
            padding: 10px 20px; 
            border: none;  
            border-radius: 4px; 
            background: var(--app-color);  
            transition: .2s
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