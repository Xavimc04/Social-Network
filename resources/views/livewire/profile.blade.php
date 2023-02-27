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
            <div><span class="material-icons">post_add</span> Posts: <a>{{ count($posts) }}</a></div>
            <div><span class="material-icons">contacts</span> Followers: <a>{{ $followers->count() }}</a></div>
            <div><span class="material-icons">verified</span> Role: <a>{{ $user->is_admin ? 'Administrator' : 'User' }}</a></div>
            
            @if (Auth::user()->name != $user->name)
                <div><span class="material-icons">fact_check</span> {{ $following ? 'Following' : 'Unfollowing' }}</div>
            @endif 
        </div>

        <div class="myself">
            @if (Auth::user()->name == $user->name)  
                <button wire:click="handlePostView">{{ $posts_view == "profile" ? 'Saved posts' : 'Profile posts' }}</button> 
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
</div>