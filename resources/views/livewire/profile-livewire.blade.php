<div>
    <div class="flex w-full justify-center items-center gap-8 mb-11">
        <div style="cursor: pointer;" wire:click='select("posts")' class="{{$selected == 'posts' ? 'border-b border-black' : ''}} justify-center items-center">
            <h1 class="text-black text-xs font-normal font-['Poppins']">Posts</h1>
        </div>
        @if ($user == Auth()->user()->id)
            <div style="cursor: pointer;" wire:click='select("albums")' class="{{$selected == 'albums' ? 'border-b border-black' : ''}}  justify-center items-center">
                <h1 class="text-black text-xs font-normal font-['Poppins']">Albums</h1>
            </div>            
        @endif
    </div>

    @if ($selected == 'posts')
        <livewire:display-posts :$user>
    
    @else
        <livewire:display-album />
    @endif

</div>
