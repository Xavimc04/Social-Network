<div class="form">  
    @if ($categories->count() > 0)
        <select name="category" wire:model="category" id="category">
            <option value="0">Uncathegorized</option>

            @foreach ($categories as $cat)
                <option :wire:key="$cat->id" value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    @else
        <input type="text" disabled value="Uncathegorized">
    @endif  
    
    <div wire:ignore>
        <div id="editor" wire:model="content"></div>   
    </div> 

    <input type="file" wire:model="image" accept="image/png, image/gif, image/jpeg" />
    <div wire:loading wire:target="image">Uploading...</div>
    <input type="submit" wire:click="create">
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    var quill = new Quill('#editor', {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'code-block']
            ]
        },
        maxLength: null,
        theme: 'snow'
    });

    quill.on('text-change', function(delta, oldDelta, source) {
        var html = document.querySelector('.ql-editor').innerHTML;
        @this.set('content', html);
    });
</script>