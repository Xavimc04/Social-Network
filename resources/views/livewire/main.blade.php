<div>
    <section class="header">
        <h1>Welcome back, <span class="color">{{ Auth::user()->name }}</span></h1>
        <h4 style="opacity: .5;">The current page has {{ $posts->count() }} posts for read...</h4>

        @if (Session::has('success'))
            <div class="success">{{ Session::get('success') }}</div>
        @else
            @if (Session::has('error'))
                <div class="error">{{ Session::get('error') }}</div>
            @endif
        @endif

        <div class="bar">
            <span class="material-icons">search</span>
            <input class="filter" wire:model.debounce.1000ms="search" type="text" name="filter" placeholder="Content, Categories (#...)">
        </div>
    </section>

    <div class="list">
        @foreach ($posts as $post)
            <x-post :post="$post" />
        @endforeach 

        <div style="padding: 20px 0px">
            <span>
                @if ($posts->onFirstPage())
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
                @if ($posts->hasMorePages())
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
    </div>
</div>

<style>
    .color:hover {
        cursor: pointer; 
    }
</style>
