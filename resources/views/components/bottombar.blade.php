<div>
    <div class="blog-bottom-fix"> 
        @if (Auth::user()->is_admin) 
            <div title="Handle theme" class="material-icons blog-handle-button">dashboard</div>
        @endif

        <div onclick="window.location.href = '/profile/{{ Auth::user()->id }}'" title="Profile" class="material-icons blog-handle-button">person</div>
        <div onclick="window.location.href = '/account-settings'" title="Settings" class="material-icons blog-handle-button">settings</div>
        <div onclick="handleCreator()" title="Create new post" class="material-icons blog-handle-button">edit_document</div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/theme.js') }}"></script> 

<style>
    .blog-bottom-fix {
        position: fixed; 
        bottom: 20px; 
        right: 20px;
    }

    .blog-handle-button {
        background: var(--app-color);
        color: white; 
        height: 50px; 
        width: 50px; 
        border-radius: 50%; 
        display: flex; 
        justify-content: center; 
        align-items: center;  
    }

    .blog-handle-button:hover {
        cursor: pointer; 
    }

    .blog-handle-button:not(:last-child) {
        margin-bottom: 5px; 
    }
</style>