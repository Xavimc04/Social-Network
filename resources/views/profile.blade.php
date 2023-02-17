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
                        <img class="rounded-image" src="{{ url($user->profile_route) }}" alt="Image">
                    @else
                        <div class="rounded-image">{{ $user->name[0] }}</div>
                    @endif

                    {{ $user->name }}
                </div>

                <div><span class="material-icons">celebration</span> Member since:  <a>{{ $user->created_at->diffForHumans() }}</a></div>
                <div><span class="material-icons">post_add</span> Posts: <a>{{ $posts->count() }}</a></div>
                <div><span class="material-icons">contacts</span> Followers: <a>{{ $followers->count() }}</a></div>
                <div><span class="material-icons">verified</span> Role: <a>{{ $user->is_admin ? 'Administrator' : 'User' }}</a></div>
                
                @if (Auth::user()->name != $user->name)
                    <div><span class="material-icons">fact_check</span> {{ $following ? 'Following' : 'Unfollowing' }}</div>
                @endif 
            </div>

            <div class="myself">
                @if (Auth::user()->name == $user->name)
                    <button onclick="handleCreator()" title="Create new post">New post</button>
                    <button onclick="handleProfiler()">Edit profile</button> 
                @else 
                    <form method="POST" action="{{ route('follow') }}">
                        @csrf 

                        <button type="submit" name="follow">{{ $following ? 'Unfollow' : 'Follow' }}</button>
                        <input type="hidden" class="hidden" name="id" value="{{ $user->id }}">
                    </form>
                @endif
            </div>

            <div class="posts">
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach 
            </div>
        </div>

        <div class="profile-edit">
            <form method="POST" class="form" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
                @csrf 

                @if (Session::has('error'))
                    <div>{{ Session::get('error') }}</div>
                @endif
                
                <div>Username</div>
                <input type="text" name="name" value="{{ $user->name }}" maxlength="30" placeholder="Username">
                <div>Profile picture</div>
                <input type="file" name="image" accept="image/png, image/gif, image/jpeg" />
                <input type="submit" value="Save changes">
            </form>
        </div>

        <x-blog-create :categories="$categories" />
        <x-bottombar /> 
    </body>

    <script> 
        const handleProfiler = () => { 
            let state = document.querySelector('.profile-edit').style.display 
    
            if(state != 'flex') { 
                document.querySelector('.profile-edit').style.display = 'flex'; 
            } else { 
                document.querySelector('.profile-edit').style.display = 'none'
            }
        }
    
        document.onkeydown = (event) => {
            let state = document.querySelector('.profile-edit').style.display 
    
            if(state != 'none') {
                if(event.key == 'Escape' || event.key == 'Esc' || event.keyCode === 27) {
                    handleProfiler(); 
                }
            }
        } 
    </script>

    <style>
        .error {
            color: rgb(224, 82, 82); 
        }

        .profile-edit {
            position: absolute; 
            height: 100%; 
            width: 100%; 
            background: rgba(2, 2, 2, 0.336); 
            z-index: 5; 
            display: none; 
            justify-content: center; 
            align-items: center; 
        } 

        form {
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

        .myself form {
            width: 100%; 
            margin: 0; 
            padding: 0; 
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