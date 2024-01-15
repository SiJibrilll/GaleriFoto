<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <h1>Livewire</h1>

    @for ($i = 0; $i < count($posts); $i++) 

        @if ($i + 7 == count($posts))
            <div x-intersect='$wire.loadMore'></div>
        @endif
        <a href="/posts/{{$posts[$i][0]}}">
            <img class="max-h-72 w-48 object-cover" src="{{asset("storage/images/postImage/" . $posts[$i][1])}}" alt="Image">
        </a>
    @endfor
</div>