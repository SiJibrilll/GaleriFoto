<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}    
        {{-- // TODO we need to find a way to decide how much collumns we need for each screens, bigger screens having more collumns  --}}
    
        {{-- 
            i have an idea
            we first need to have one main flex col, which will be filled by php with posts
            then a few other "stored" flex cols
            with javascript we can decide how big is our screen to decide how much columns are we deviding into
            then with javascript, we can count the number of childrends the main flex has. Then we can devide those childrens
            into equal numbers with the other flex cols.
            
            
            
            --}}
    
            
            <div class="main-flex-col"> 
                @for ($i = 0; $i < $this->numColumns; $i++) 

                    {{-- this div is used to trigger the infinite scrolling --}}
                    @if ($i + 7 == count($posts))
                        <div x-intersect='$wire.loadMore'></div>
                    @endif

                    {{-- post cards --}}
                    <div wire:key='{{$i}}' class="mb-2 max-w-44 overflow-hidden rounded-2xl main-{{$posts[$i][0]}}" onclick="window.location.href = '/posts/show/{{$posts[$i][0]}}';">
                        {{-- post thumbnail --}}
                        <img class="hidden relative  object-cover brightness-95" src="{{asset("storage/images/postImage/" . $posts[$i][1])}}" alt="Image" onload="loaded({{$posts[$i][0]}})">
                        
                        {{-- placeholder skeleton loader --}}
                        <div id="loader" class="relative space-y-8 animate-pulse  rtl:space-x-reverse">
                            <div class="flex items-center justify-center w-full h-48 bg-gray-300 rounded dark:bg-gray-700">
                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                </svg>
                            </div> 
                            <span class="sr-only">Loading...</span>
                        </div>
                    
                    
                    </div>
                @endfor
            </div>

            @for ($i = 0; $i < $this->numColumns; $i++)
                <div class="stored-flex-col" wire:key="stored-col-{{ $i }}">
                    @slot('stored', $i)
                        {{-- post cards --}}
                    <div wire:key='{{$i}}' class="mb-2 max-w-44 overflow-hidden rounded-2xl main-{{$posts[$i][0]}}" onclick="window.location.href = '/posts/show/{{$posts[$i][0]}}';">
                        {{-- post thumbnail --}}
                        <img class="hidden relative  object-cover brightness-95" src="{{asset("storage/images/postImage/" . $posts[$i][1])}}" alt="Image" onload="loaded({{$posts[$i][0]}})">
                        
                        {{-- placeholder skeleton loader --}}
                        <div id="loader" class="relative space-y-8 animate-pulse  rtl:space-x-reverse">
                            <div class="flex items-center justify-center w-full h-48 bg-gray-300 rounded dark:bg-gray-700">
                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                </svg>
                            </div> 
                            <span class="sr-only">Loading...</span>
                        </div>
                    
                    
                    </div>
                    @endslot
                </div>
            @endfor


    <script> // script to show the image once it loads
        function loaded($key) {
            let main = document.querySelector('.main-' + $key);           

            main.querySelector('img').classList.remove('hidden');
            main.querySelector('div').classList.add('hidden')
        }

    </script>
</div>