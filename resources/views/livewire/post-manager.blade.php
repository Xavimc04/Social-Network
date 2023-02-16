<div class="actions">   
    <button name="action" class="section" wire:click="like">
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
