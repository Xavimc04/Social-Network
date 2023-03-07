<div>
    <div class="middle">
        <div class="header">
            <h1>Active chats, <span class="color">{{ Auth::user()->name }}</span></h1>
        </div>

        <div class="bar">
            <span class="material-icons">search</span>
            <input class="filter" wire:model.debounce.1000ms="search" type="text" name="filter" placeholder="Chats, persons...">
        </div>

        Aquí solamente el filtro, para enviar nuevo mensaje y para ver los chats en que estás. 
        Una vez cliques dentro ya te mando al chat. 
    </div> 
</div> 

<style>
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
</style>
