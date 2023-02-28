<div class="blog-create">
    @livewire('post.post', [
        "categories" => $categories
    ]); 
    
    @livewireScripts 
</div>

<style>
    .blog-create {
        position: fixed; 
        height: 100%; 
        width: 100%; 
        background: rgba(2, 2, 2, 0.336); 
        z-index: 5;
        display: none;   
        justify-content: center; 
        align-items: center;  
    } 

    .form {
        background: var(--bg-color); 
        padding: 20px; 
        border-radius: 4px; 
        width: 400px; 
    }

    .form div {
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

    #editor {
        max-height: 50vh;  
        border: none;   
        overflow: scroll; 
    }

    .ql-toolbar {
        border: none; 
    }

    .ql-toolbar.ql-snow {
        border: none;
    } 

    .ql-editor {
        font-size: 16px;
        line-height: 1.5;
        border: none; 
    }  
</style>