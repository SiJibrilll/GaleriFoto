<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <h1>posts</h1>

    



    @for ($i = 0; $i < count($posts); $i++) 

        @if ($i + 7 == count($posts))
            <div x-intersect='$wire.loadMore'></div>
        @endif
        {{-- //TODO implement lazy loading --}}
        
        <livewire:image-loader wire:key='{{$i}}' imgKey='{{$i}}' url='{{asset("storage/images/postImage/" . $posts[$i][1])}}' />        

        {{-- <a wire:key='{{$i}}' href="/posts/show/{{$posts[$i][0]}}">
        </a> --}}
    @endfor
</div>