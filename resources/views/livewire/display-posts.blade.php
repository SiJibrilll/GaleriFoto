<div>      
    <div class="flex flex-row w-full">
        @foreach ($columns as $colKey => $column)
            <div wire:key='{{$colKey}}' class="flex flex-col w-full items-center">
                @foreach ($column as $postKey => $post)
                    {{-- post cards --}}
                    <div wire:key='{{$postKey}}' x-init='init({{$post[0]}})' style="cursor: pointer;" class="relative hover:brightness-75 transition-all mb-2 w-full max-w-44 xl:max-w-72 overflow-hidden rounded-2xl main-{{$post[0]}}" onclick="window.location.href = '/posts/show/{{$post[0]}}';">

                        {{-- post thumbnail --}}
                        <img class="object-cover brightness-95" src="{{asset("storage/images/postImage/" . $post[1])}}" alt="Image" x-on:load="loaded({{$post[0]}})">
                        
                        {{-- placeholder skeleton loader --}}
                        <div id="loader" class="hidden space-y-8 animate-pulse w-full rtl:space-x-reverse">
                            <div class="flex items-center justify-center w-full h-48 bg-gray-300 rounded dark:bg-gray-700">
                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                </svg>
                            </div> 
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    
                    @if ($loop->last && !$thatsAll)
                        <div x-intersect='$wire.loadMore'></div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    
    @if (count($columns[0]) < 1)

            @isset($album)
            <div class="w-full h-full flex flex-col justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 h-auto text-gray-800 mt-32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>
                <h1 class=" text-gray-800 text-4xl font-black font-['Poppins'] mt-5">Start saving</h1>
                <h1 class=" text-gray-600 text-xl font-normal font-['Poppins'] mt-5">Save beloved posts to your album</h1>
            </div>
            @else
            <div class="w-full h-full flex flex-col justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-28 h-auto text-gray-800 mt-32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
                  
                  
                <h1 class="xl text-gray-600 text-xl font-normal font-['Poppins'] mt-5">No posts found</h1>
            </div>

            @endisset
                   
        @else
        <div class="w-full" wire:loading>
            <img class="mx-auto" src="{{asset("storage/images/assets/loading.svg" )}}" alt="">
        </div>
        @endif

    <script> // script to show the image once it loads
        function init(key) {
            let main = document.querySelector('.main-' + key);           

            main.querySelector('img').classList.add('hidden');
            main.querySelector('div').classList.remove('hidden')
        }

        function loaded($key) {
            let main = document.querySelector('.main-' + $key);           

            main.querySelector('img').classList.remove('hidden');
            main.querySelector('div').classList.add('hidden')
        }
    </script>

<script>
    // func to get screen size
    function getScreenSize() {
        if (window.matchMedia('(min-width: 1280px)').matches) {
            return 5 // if its larger than 1280px, return desktop
        }

        if (window.matchMedia('(min-width: 768px)').matches) {
            return 4 // if its larger than 768px, return tablet
        }

        return 2 // if nothing matches, then we are in portrait mobile screen

    }
    

    window.addEventListener("resize", function() {
        // Your function to handle screen size changes
        @this.call('updateLayout', getScreenSize());
    });
    
    setTimeout(() => {
        @this.call('updateLayout', getScreenSize());        
    }, 100);
    </script>    
</div>