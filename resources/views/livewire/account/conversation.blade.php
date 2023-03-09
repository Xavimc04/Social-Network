<div class="middle">
    <div class="header">
        @if ($conversation->icon != null)
            <img class="no-image" src="{{ url($conversation->icon) }}" alt="Image">
        @else
            <div class="no-image" style="background: var(--app-color);">Hola</div>
        @endif

        <div>{{ $conversation->name }}</div>
    </div>

    <div class="messages" onload="scrollToBottom()">
        @foreach ($conversation->messages as $message)
            <div class="single-message {{ $message->sender_id == Auth::user()->id ? 'self' : 'target' }}">
                <div class="sender">{{ $message->sender_id }}</div>
                <div class="content">{{ $message->message }}</div>
                <div class="hour">{{ $message->created_at->diffForHumans() }}</div>
            </div>
        @endforeach
    </div>

    <div class="input-handler">
        <input type="text" wire:model.defer="input" placeholder="Type here..." />
        <div class="material-icons">add_reaction</div>
        <div class="material-icons">gif</div>
        <div class="material-icons">image</div>
        <div class="material-icons button" wire:click="sendMessage">sms</div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    Echo.join('chat')
        .listen('ChatMessage', (event) => {
            const Schema = `
                <div class="single-message target">
                    <span>Falta por saber si esto es target o self</span>
                    <div class="sender">${ event.message.sender_id }</div>
                    <div class="content">${ event.message.message }</div>
                    <div class="hour">Just now</div>
                </div>
            `;

            document.querySelector('.messages').insertAdjacentHTML("beforeend", Schema);
        })
</script>

<style>
    .header {
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

    .middle {
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .messages {
        width: 100%;
        flex: 1;
        overflow-y: scroll;
        -ms-overflow-style: none;
        scrollbar-width: none;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .messages::-webkit-scrollbar {
        display: none;
    }

    .input-handler {
        margin: 20px 0px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .input-handler input {
        width: 65%;
        padding: 10px 15px;
        background-color: rgba(0, 0, 0, 0.068);
        font-family: 'Nunito', sans-serif;
        border: none;
        font-size: 1.05rem;
        color: var(--input-color);
    }

    .input-handler input:focus {
        outline: none;
    }

    .input-handler div {
        padding: 8px 8px;
        color: var(--main-color);
    }

    .input-handler .button {
        background: var(--app-color);
        border-radius: 4px;
        color: black;
    }

    .input-handler div:hover {
        user-select: none;
        cursor: pointer;
        opacity: .6;
    }

    .single-message {
        margin-top: 10px;
        max-width: 350px;
        padding: 10px;
        border-radius: 3px;
        margin-bottom: 10px;
    }

    .self {
        align-self: flex-end;
        background: rgb(82, 82, 82);
        color: whitesmoke;
    }

    .target {
        align-self: flex-start;
        background: rgb(109, 124, 212);
        color: white;
    }

    .sender {
        font-size: 1.2rem;
    }

    .content {
        margin-top: 10px;
    }

    .hour {
        margin-top: 10px;
        opacity: .6;
    }
</style>
