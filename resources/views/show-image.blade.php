<x-layout>
<div class="md:bg-gray-800 md:h-screen">
        <div class="md:mx-auto md:max-w-3xl">
            @foreach ($post->images as $image)

            {{-- // TODO the blacj bg doesnt wrap up fully when content is short --}}
            <img class="h-auto object-cover md: md:w-full mt-10" src="{{asset("storage/images/postImage/" . $image->image)}}"
                alt="Image">

                <div class=" fixed z-10 top-10 xl:top-20 left-0 right-0 h-12 flex flex-row items-center justify-between xl:h-20 md:mx-auto md:max-w-3xl">
                    <button onclick="window.history.back()" class="absolute top-0 left-0 m-4 bg-black bg-opacity-45 p-2 rounded-full text-white hover:bg-opacity-75 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 md:w-10 md:h-10">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>