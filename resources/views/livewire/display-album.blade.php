<div>
    {{-- Care about people's approval and you will be their prisoner. --}}


    @for ($i = 0; $i < count($album); $i++) 

        @if ($i + 7 == count($album))
            <div x-intersect='$wire.loadMore'></div>
        @endif
        <a href="/albums/show/{{$album[$i][0]}}">
            <img class="max-h-72 w-48 object-cover" src="{{asset("storage/images/postImage/" . $album[$i][1])}}" alt="Image">
        </a>
    @endfor
</div>
