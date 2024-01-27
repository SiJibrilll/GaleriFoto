<div >
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}    
        {{-- // TODO we need to find a way to decide how much collumns we need for each screens, bigger screens having more collumns  --}}
        
        <div class="grid">
            @for ($i = 0; $i < count($posts); $i++) 
        
            @if ($i + 7 == count($posts))
                <div class="grid-item" x-intersect='$wire.loadMore'></div>
            @endif

            <div class="block">
                <img class="relative  object-cover brightness-95" src="{{asset("storage/images/postImage/" . $posts[$i][1])}}" alt="Image">
            </div>
            @endfor
        </div>

    <script> // script to show the image once it loads
        function loaded($key) {
            let main = document.querySelector('.main-' + $key);           

            main.querySelector('img').classList.remove('hidden');
            main.querySelector('div').classList.add('hidden')
        }
    </script>
</div>