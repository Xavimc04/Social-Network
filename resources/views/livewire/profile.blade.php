<div>
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
                <button onclick="handleProfiler()">Edit profile</button> 
            @else 
                <button wire:click="handleFollow">{{ $following ? 'Unfollow' : 'Follow' }}</button>
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
</div>