<div class="blog-create">
    <form method="POST" action="{{ route('post.new') }}" enctype="multipart/form-data">
        @csrf 
        
        @if ($categories->count() > 0)
            <select name="category" id="category">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        @else
            <input type="text" disabled value="Uncathegorized">
        @endif 
        
        <input type="hidden" name="identifier" value="{{ Auth::user()->id }}">
        <textarea spellcheck="false" name="content" placeholder="Information here..."></textarea> 
        <input type="file" name="image" accept="image/png, image/gif, image/jpeg" />
        <input type="submit" value="Create">
    </form>
</div>

<script> 
    const handleCreator = () => { 
        let state = document.querySelector('.blog-create').style.display 

        if(state != 'flex') { 
            document.querySelector('.blog-create').style.display = 'flex'; 
        } else { 
            document.querySelector('.blog-create').style.display = 'none'
        }
    }

    document.onkeydown = (event) => {
        let state = document.querySelector('.blog-create').style.display 

        if(state != 'none') {
            if(event.key == 'Escape' || event.key == 'Esc' || event.keyCode === 27) {
                handleCreator(); 
            }
        }
    } 
</script>

<style>
    .blog-create {
        position: absolute; 
        height: 100%; 
        width: 100%; 
        background: rgba(2, 2, 2, 0.336); 
        z-index: 5;
        display: none;   
        justify-content: center; 
        align-items: center; 
    } 

    form {
        background: var(--bg-color); 
        padding: 20px; 
        border-radius: 4px; 
        width: 400px; 
    }

    form div {
        margin-top: 10px; 
    }

    textarea { 
        margin-top: 10px; 
        resize: vertical;   
        border: none;    
        background-color: var(--input-bg);
        color: var(--input-color);   
        max-height: 50vh; 
        min-height: 100px; 
        border-radius: 4px; 
        padding: 10px 10px;  
    } 

    textarea:focus {
        outline: none; 
    }
</style>