<div> 
    <div class="material-icons back" onclick="window.location.href = '/'">arrow_back</div>

    <section class="header">
        <div class="flex">
            @if ($user->profile_route != null)
                <img class="rounded-image" src="{{ url($user->profile_route) }}" alt="Image">
            @else
                <div class="rounded-image" style="background: var(--app-color);">{{ $user->name[0] }}</div>
            @endif

            <div class="profile">
                <div class="username">{{ $user->name }}</div>
                <div>Account created {{ $user->created_at->diffForHumans() }}</div>
            </div>
        </div>

        <div class="save" wire:click="save">Save settings</div>
    </section> 

    <div class="settings">
        <div class="option">
            <div class="left">
                <span class="material-icons">dark_mode</span>
                <div>Themes</div>
            </div>

            <select class="theme-selector" onchange="handleTheme()"> 
                <option value="light">Light</option>
                <option value="dark">Dark</option> 
            </select>
        </div>

        <div class="option">
            <div class="left">
                <span class="material-icons">tune</span>
                <div>Name</div>
            </div>

            <div class="edit_input">
                <input type="text" wire:model="name" {{ $editing_name ? '' : 'disabled' }} maxlength="30">
                
                @if ($editing_name) 
                    <div wire:click="handleEdit" class="material-icons">close</div>
                @else 
                    <div wire:click="handleEdit" class="material-icons">edit</div>
                @endif 
            </div>
        </div>

        <div class="option">
            <div class="left">
                <span class="material-icons">photo_camera</span>
                <div>Profile picture</div>
            </div>

            <div>
                <input type="file" style="display: none" id="image-selector" wire:model="image" accept="image/png, image/gif, image/jpeg"/>
                <label for="image-selector"><span class="material-icons">more_vert</span></label>
            </div>
        </div>

        <div class="option">
            <div class="left">
                <span class="material-icons">notifications</span>
                <div>Notifications</div>
            </div>
        </div>

        <div class="option">
            <div class="left">
                <span class="material-icons">translate</span>
                <div>Language</div>
            </div>
        </div>

        <div class="option">
            <div class="left">
                <span class="material-icons">contact_support</span>
                <div>Contact support</div>
            </div>
        </div>

        <div class="option">
            <div class="left">
                <span class="material-icons">question_mark</span>
                <div>Help</div>
            </div>
        </div>

        <div class="option">
            <div class="left">
                <span class="material-icons">apartment</span>
                <div>About us</div>
            </div>
        </div>

        <div class="option" onclick="window.location.href = '/logout'">
            <div class="left">
                <span class="material-icons">logout</span>
                <div>Logout</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/theme.js') }}"></script>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        document.querySelector('.theme-selector').value = localStorage.getItem('theme'); 
    })
</script>

<style>
    .back {
        margin-top: 20px; 
        opacity: .5; 
        width: 100%;
        transition: .5s; 
        font-weight: 900; 
    }

    .back:hover {
        opacity: 1;
        transition: .5s; 
        color: var(--app-color); 
        cursor: pointer; 
    }

    .header {
        margin-top: 40px; 
        display: flex; 
        flex-direction: row; 
        justify-content: space-between
    }

    .header .save {
        background: transparent;  
        border: 1px solid gray; 
        color: gray; 
        border-radius: 4px; 
        font-size: 1.1rem; 
        padding: 0px 20px; 
        display: flex; 
        align-items: center;  
        transition: .4s
    }

    .header .save:hover {
        cursor: pointer; 
        user-select: none; 
        border: 1px solid var(--app-color); 
        background: var(--app-color);
        box-shadow: 0px 0px 10px var(--app-color); 
        color: black; 
        transition: .4s
    }

    .header .flex {
        display: flex; 
        flex-direction: row; 
        align-items: center; 
    }

    .header .flex .profile {
        display: flex; 
        flex-direction: column;  
    }

    .header .flex .profile .username {
        font-weight: 900; 
        font-size: 1.4rem; 
    }

    .settings { 
        width: 100%; 
        display: flex; 
        margin-top: 50px; 
        flex-direction: column; 
        margin-bottom: 30px; 
    }

    .settings .option { 
        width: 100%; 
        display: flex; 
        flex-direction: row; 
        align-items: center; 
        justify-content: space-between;  
        padding-bottom: 15px; 
    }

    .settings .option:not(:first-child) {
        margin-top: 15px; 
    }

    .settings .option .left {
        display: flex; 
        align-items: center; 
    }

    .settings .option .left span {
        background: var(--app-color); 
        color: var(--bg-color); 
        padding: 10px; 
        border-radius: 50%; 
    }

    .settings .option .left div {
        margin-left: 10px; 
        font-size: 1.1rem; 
    }

    .rounded-image {
        width: 50px; 
        height: 50px;  
        color: var(--bg-color);  
        margin-right: 20px; 
        border-radius: 50%; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
    }

    select {
        margin-top: 0; 
        width: auto; 
        background: transparent; 
        padding: 0px 20px; 
        color: var(--main-color); 
    }

    .edit_input { 
        display: flex; 
        flex-direction: row; 
        align-items: center; 
    }

    .edit_input input {
        font-size: 1.1rem; 
        width: 150px; 
        background: var(--input-bg);
        color: var(--input-color); 
        border: none; 
        text-align: left; 
        padding: 5px 10px; 
        border-radius: 4px; 
        margin-right: 10px; 
    }

    input:focus {
        outline: none; 
    }

    .edit_input div {
        margin: 0px 5px; 
        transition: .3s
    }

    .edit_input div:hover {
        cursor: pointer; 
        user-select: none; 
        color: var(--app-color); 
        transition: .3s
    }
</style>
