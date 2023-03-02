<div>
    <nav class="nav">
        <div wire:click="setPage('categories')" class="{{ $selected == 'categories' ? 'selected' : '' }}">Categories</div>
        <div wire:click="setPage('accounts')" class="{{ $selected == 'accounts' ? 'selected' : '' }}">Accounts</div>
        <div wire:click="setPage('posts')" class="{{ $selected == 'posts' ? 'selected' : '' }}">Posts</div>
        <div wire:click="setPage('roles')" class="{{ $selected == 'roles' ? 'selected' : '' }}">Roles</div>
        <div wire:click="setPage('permissions')" class="{{ $selected == 'permissions' ? 'selected' : '' }}">Permissions</div>
    </nav>
</div>

<style>
    .nav { 
        width: 100%; 
        display: flex; 
        flex-direction: row; 
        padding: 20px 0px; 
    }

    .nav div:not(:first-child) {
        margin-left: 25px; 
    }

    .nav div {
        user-select: none; 
        cursor: pointer; 
        border-bottom: 4px solid gray; 
        padding-bottom: 10px; 
        transition: .4s;
    }

    .nav div:hover {
        opacity: .6;
        transition: .4s; 
    }

    .nav .selected {
        color: var(--app-color); 
        border-bottom: 4px solid var(--app-color); 
        transition: .4s;
    }
</style>
