<div>
    
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}    
        {{-- // TODO we need to find a way to decide how much collumns we need for each screens, bigger screens having more collumns  --}}
    
        <div class="grid">
            @for ($i = 0; $i < count($posts); $i++) 

            <div class="grid-item main-{{$posts[$i][0]}}">
                <img class=" object-cover brightness-95" src="{{asset("storage/images/postImage/" . $posts[$i][1])}}" alt="Image" onload="">
                
            </div>
            @endfor
          </div>


    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script>
    // script to show the image once it loads
    function loaded($key) {
        let main = document.querySelector('.main-' + $key);           

        main.querySelector('img').classList.remove('hidden');
        main.querySelector('div').classList.add('hidden')
    }

    var elem = document.querySelector('.grid');
    var msnry = new Masonry( elem, {
    // options
    itemSelector: '.grid-item',
    columnWidth: 600
    });  
    
    
    </script>
</div>