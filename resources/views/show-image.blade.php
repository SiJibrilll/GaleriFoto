<x-layout>
    @foreach ($post->images as $image)
    
        @if ($loop->first < 1)
        <img class="max-w-auto h-auto object-cover" src="{{asset("storage/images/postImage/" . $image->image)}}"
        alt="Image">
        @continue
        @endif
        
        
        <div class="relative">
            <img class="max-w-auto h-auto object-cover" src="{{asset("storage/images/postImage/" . $image->image)}}"
            alt="Image">
            <button onclick="window.history.back()" class="absolute top-0 left-0 m-4 bg-black bg-opacity-75 p-2 rounded-full text-white hover:bg-opacity-75 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            </button>    
        </div>

    @endforeach
</x-layout>