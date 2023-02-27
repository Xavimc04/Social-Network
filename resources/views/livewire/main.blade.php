<div>
    <section class="header">
        <h1>Welcome back, <span class="color">{{ Auth::user()->name }}</span></h1>

        @if ($profiles != null)
            <h4 style="opacity: .5;">We fount {{ count($profiles) }} profiles from your request...</h4>
        @else
            <h4 style="opacity: .5;">The current page has {{ count($posts) }} posts for read...</h4>
        @endif

        @if (Session::has('success'))
            <div class="success">{{ Session::get('success') }}</div>
        @else
            @if (Session::has('error'))
                <div class="error">{{ Session::get('error') }}</div>
            @endif
        @endif

        <div class="bar">
            <span class="material-icons">search</span>
            <input class="filter" wire:model.debounce.1000ms="search" type="text" name="filter" placeholder="Content, Categories, Profiles...">
        </div>

        <div class="filter_actions">
            <button class="filter_type {{ $filter_type == 'posts' ? 'selected' : '' }}" wire:click="filterByType('posts')">Posts</button>
            <button class="filter_type {{ $filter_type == 'categories' ? 'selected' : '' }}" wire:click="filterByType('categories')">Categories</button>
            <button class="filter_type {{ $filter_type == 'profiles' ? 'selected' : '' }}" wire:click="filterByType('profiles')">Profiles</button>

            @if ($filter_type == 'posts')
                <select wire:model.lazy="perPage" class="perPage">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="40">40</option>
                </select>
            @endif
        </div>
    </section>

    <div class="list">
        @if ($profiles != null)
            @if($profiles->count() > 0) 
                @foreach ($profiles as $profile) 
                    <div class="profile" onclick="window.location.href = '/profile/{{ $profile->id }}'">
                        @if ($profile->profile_route != null)
                            <img class="no-image" src="{{ url($profile->profile_route) }}" alt="Image">
                        @else
                            <div class="no-image">{{ $profile->name[0] }}</div>
                        @endif
            
                        <strong>{{ $profile->name }}</strong>
            
                        @if ($profile->is_admin)
                            <span class="material-icons">verified</span>
                        @endif
                    </div>
                @endforeach
            @else 
                <div>No profiles founded</div>
            @endif  
        @else    
            @if ($filter_type == 'categories' && count($posts) == 0)
                <div class="categories">
                    @foreach ($categories as $category)
                        <div wire:click="setSearch('{{ $category->name }}', 'categories')">#{{ $category->name }}</div>
                    @endforeach
                </div>
            @endif

            @foreach ($posts as $post)
                <x-post :post="$post" />
            @endforeach 
            
            @if (count($posts) > 0)    
                <div style="padding: 20px 0px">
                    <span>
                        @if ($posts->onFirstPage())
                            <span>
                                {!! __('pagination.previous') !!}
                            </span>
                        @else
                            <span class="color" wire:click="previousPage">
                                {!! __('pagination.previous') !!} 
                            </span>
                        @endif
                    </span>
                    
                    <span>
                        @if ($posts->hasMorePages())
                            <span class="color" wire:click="nextPage">
                                {!! __('pagination.next') !!}
                            </span>
                        @else
                            <span>
                                {!! __('pagination.next') !!}
                            </span>
                        @endif
                    </span>
                </div>
            @endif
        @endif
    </div>
</div>

<style>
    .categories {
        width: 100%; 
        margin-top: 20px; 
        display: flex; 
        flex-wrap: wrap; 
    }

    .categories div {
        opacity: 1;
        margin-right: 10px; 
        background: var(--app-color); 
        color: black; 
        border-radius: 4px; 
        padding: 5px 10px;  
        transition: .4s
    }

    .categories div:hover {
        cursor: pointer; 
        opacity: .8;
        transition: .4s
    }

    .filter_actions {
        display: flex; 
        flex-wrap: wrap; 
        width: 100%; 
        margin-top: 20px; 
    }

    .filter_type {
        padding: 10px 15px; 
        background: transparent; 
        border: none; 
        border: 2px solid var(--main-color); 
        border-radius: 4px; 
        color: var(--main-color); 
        opacity: .6;
    }

    .filter_type:not(:first-child) {
        margin-left: 10px; 
    }

    .selected {
        opacity: 1;
        border: 2px solid var(--app-color);  
        color: var(--app-color); 
    }

    .perPage {
        width: 100px;
        margin-top: 0px; 
        margin-left: 10px; 
        background: transparent; 
        color: var(--main-color); 
    }

    .color:hover {
        cursor: pointer; 
    }

    .no-image {
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

    .profile {
        display: flex; 
        align-items: center; 
        margin-top: 20px;    
        margin-bottom: 20px;   
        padding: 10px 10px;
        border-radius: 3px;    
        background-color: rgba(0, 0, 0, 0.068);
        border-left: 10px solid rgba(0, 0, 0, 0.068); 
        transition: border-color .4s; 
    }

    .profile:hover {
        cursor: pointer; 
        transition: border-color .4s; 
        border-left: 10px solid var(--app-color); 
        user-select: none; 
    }

    .profile span {
        margin-left: 10px; 
        color: var(--app-color); 
    } 
</style>
