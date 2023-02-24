<div class="post">
    <div class="right">
        <h3 class="user" onclick="window.location.href = '/profile/{{ $post->user->id }}'">
            @if ($post->user->profile_route != null)
                <img class="no-image" src="{{ url($post->user->profile_route) }}" alt="Image">
            @else
                <div class="no-image">{{ $post->user->name[0] }}</div>
            @endif

            {{ $post->user->name }}

            @if ($post->user->is_admin)
                <span class="material-icons">verified</span>
            @endif
        </h3>

        <div class="stamp"> 
            @if ($post->category_name != null)
                <div class="category" title="filter category" wire:click="setSearch('{{ $post->category_name }}', 'categories')">#{{ $post->category_name }}</div>
            @endif

            <div>{{ $post->created_at }}</div>
        </div>

        <div class="content">{{ $post->content }}</div>
    </div>

    @if ($post->file_route != null)    
        <div class="left">
            <img class="image" onclick="window.open('{{ url($post->file_route) }}')" src="{{ url($post->file_route) }}" alt="Image">
        </div>
    @endif

    <div class="actions">   
        <button name="action" class="section" wire:click="like({{ $post->id }})">
            <span class="material-icons">favorite</span>
            {{ $post->likes == null ? 0 : count($post->likes) }}
        </button> 

        <button name="action" class="section">
            <span class="material-icons">mark_chat_unread</span>
            Comment
        </button> 
    
        @if (Auth::user()->id != $post->user_id)
            <button name="action" class="section">
                <span class="material-icons">report</span>
                Report
            </button> 
        
            <button class="section" wire:click="save({{ $post->id }})">
                <span class="material-icons">bookmark</span>
                {{ $post->is_saved ? 'Saved' : 'Save' }}
            </button> 
        @else 
            <button class="section" wire:click="delete({{ $post->id }})">
                <span class="material-icons">delete</span>
                Delete
            </button> 
        @endif
    </div>     
</div>

<style>
    * {
        user-select: none
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

    .post {  
        margin-top: 20px;   
        width: 100%; 
        margin-bottom: 20px;   
        padding: 5px 5%; 
        background-color: rgba(0, 0, 0, 0.068);
    }

    .post .content { 
        width: 90%; 
    }

    .stamp {
        width: 100%;  
        margin-bottom: 20px; 
        font-size: .9rem; 
        display: flex; 
        align-items: center
    }

    .stamp div {
        opacity: .6;
    }

    .stamp .category {
        opacity: 1;
        margin-right: 10px; 
        background: var(--app-color); 
        color: black; 
        border-radius: 4px; 
        padding: 5px 10px;  
        transition: .4s
    }

    .stamp .category:hover {
        cursor: pointer; 
        opacity: .8;
        transition: .4s
    }

    .post .left {  
        display: flex; 
        justify-content: center;   
        margin: 20px 0px; 
        width: 90%; 
        border-radius: 4px; 
    }

    .actions {
        padding: 20px 0px 10px 0px; 
        width: 90%; 
        display: flex; 
        flex-direction: row; 
        background: transparent; 
        align-items: center; 
        justify-content: space-evenly; 
    }

    .actions .section {
        all: unset; 
        display: flex; 
        align-items: center; 
        opacity: 1;
        transition: .4s
    }

    .actions .section:hover {
        cursor: pointer;  
        opacity: .7;
        transition: .4s
    }
    
    .actions .section span {
        margin: 0px 10px; 
        color: var(--app-color); 
    }

    .post .left img {
        max-height: 250px; 
        max-width: 100%;  
    }

    .post .right {  
        width: 100%;    
        position: relative; 
    }

    .right .user {
        display: flex; 
        align-items: center; 
    }

    .right .user span {
        margin-left: 10px; 
        color: var(--app-color); 
    }

    .user:hover {
        user-select: none; 
        cursor: default; 
    } 

    .image:hover {
        cursor: zoom-in
    }
</style>