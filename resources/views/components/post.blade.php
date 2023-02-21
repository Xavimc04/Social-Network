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

        <div class="stamp">{{ $post->created_at }}</div>
        <div class="content">{{ $post->content }}</div>
    </div>

    @if ($post->file_route != null)    
        <div class="left">
            <img src="{{ url($post->file_route) }}" alt="Image">
        </div>
    @endif

    <div class="actions">   
        <button name="action" class="section" wire:click="like({{ $post->id }})">
            <span class="material-icons">favorite</span>
            {{ $post->likes == null ? 0 : count($post->likes) }}
        </button> 
    
        <button name="action" class="section">
            <span class="material-icons">report</span>
            Report
        </button> 
    
        <button class="section">
            <span class="material-icons">bookmark</span>
            Save
        </button> 
    </div>     
</div>

<style>
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
        opacity: .6;
        font-size: .9rem; 
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
    }

    .actions .section:hover {
        cursor: pointer; 
        transform: scale(.90);  
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
</style>