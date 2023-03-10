<div class="middle">
    <div class="header">
        <h2>Active chats, <span class="color">{{ Auth::user()->name }}</span></h2>
    </div>

    <div class="bar">
        <span class="material-icons">search</span>
        <input class="filter" wire:model.debounce.1000ms="search" type="text" name="filter" placeholder="Chats, persons...">
    </div>

    <div class="filter_actions">
        <button onclick="handleCreator()">New group</button>

        <select wire:model.lazy="perPage" class="perPage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="40">40</option>
        </select>

        <select wire:model.lazy="orderBy" class="perPage">
            <option value="new">Newer</option>
            <option value="old">Older</option>
            <option value="unreaded">Unreaded</option> 
        </select>

        <select class="perPage">
            <option>All</option>
            <option>Privates</option>
            <option>Groups</option> 
        </select>
    </div>

    <div class="group_creation"> 
        <div class="section">
            <input type="text" wire:model="group_name" placeholder="Group name"> 
            
            <div>
                <input type="file" style="display: none" id="image-selector" wire:model="group_icon" accept="image/png, image/gif, image/jpeg"/>
                <label for="image-selector"><span class="material-icons">more_vert</span></label>
            </div>

            <button>Create</button>
        </div>
        
        <div class="section">
            <input type="text" placeholder="Member">
            <button>Add member</button>    
        </div>  
    </div>

    @if (count($profiles) > 0)
        @foreach ($profiles as $person)
            <div class="profile" wire:click="startChat('{{ $person->id }}')">
                @if ($person->profile_route != null)
                    <img class="no-image" src="{{ url($person->profile_route) }}" alt="Image">
                @else
                    <div class="no-image" style="background: var(--app-color);">{{ $person->name[0] }}</div>
                @endif
    
                <strong>{{ $person->name }}</strong> 
            </div>
        @endforeach

        <div class="performance-info">
            To improve the performance of the application we can only show you the 5 profiles that match your search. If you can't find the desired profile, try to carry out a more specific search.
        </div>
    @endif

    @if (count($chats) > 0)
        @foreach ($chats as $chat)
            <div class="profile" onclick="window.location.href = '/chats/{{ $chat->id }}'">
                @if ($chat->icon != null)
                    <img class="no-image" src="{{ url($chat->icon) }}" alt="Image">
                @else
                    <div class="no-image" style="background: var(--app-color);">{{ $chat->name[0] }}</div>
                @endif

                <div>{{ $chat->name }}</div> 
            </div>
        @endforeach  
    @endif 

    @if (count($whereIPertain) > 0)    
        <div style="padding: 20px 0px">
            <span>
                @if ($whereIPertain->onFirstPage())
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
                @if ($whereIPertain->hasMorePages())
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
</div> 

<script>
    const handleCreator = () => { 
        let state = document.querySelector('.group_creation').style.display 

        if(state != 'flex') { 
            document.querySelector('.group_creation').style.display = 'flex'; 
        } else { 
            document.querySelector('.group_creation').style.display = 'none'
        }
    }
</script>

<style> 
    .group_creation {
        width: 100%;  
        display: none; 
        flex-direction: column;   
        margin-top: 15px;  
    }

    .group_creation .section {
        width: 100%;   
        margin: 15px 0px; 
        display: flex; 
        flex-direction: row;  
        justify-content: space-between; 
        align-items: center;  
    }

    button {
        padding: 10px 15px; 
        border: none; 
        border-radius: 4px; 
        font-size: 1.03rem;
        background: var(--app-color); 
    }

    .group_creation .section input[type="text"] {
        border: none; 
        background: rgba(0, 0, 0, 0.068); 
        padding: 10px 15px; 
        width: 70%; 
        color: var(--input-color);   
        font-size: 1.03rem; 
    }

    .group_creation .section input[type="text"]:focus {
        outline: none; 
    }

    .filter_actions {
        display: flex; 
        flex-wrap: wrap; 
        width: 100%; 
        margin-top: 20px; 
    }

    .perPage {
        width: 100px;
        margin-top: 0px; 
        margin-left: 10px; 
        background: transparent; 
        color: var(--main-color); 
    }

    .bar {
        display: flex; 
        width: 100%;
        align-items: center;  
        background: rgba(0, 0, 0, 0.068); 
        padding: 5px 0px; 
        border-radius: 5px; 
    }

    .bar span {
        padding: 0px 15px; 
    }

    .bar input {
        background: none;
        font-family: 'Nunito', sans-serif;  
        border: none; 
        padding: 5px 10px; 
        font-size: 1.1rem; 
        color: var(--input-color);
        width: 350px;  
    }

    .bar input:focus {
        outline: none
    }

    .no-image {
        width: 40px; 
        height: 40px;  
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

    .performance-info {
        margin-bottom: 10px; 
        background: var(--app-color);
        border-radius: 4px;
        padding: 15px;   
    } 
</style>
