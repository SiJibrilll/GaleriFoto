<div>

    <div class="lg:hidden fixed z-50 top-0 left-0 right-0 h-16 bg-white flex items-center justify-between pt-3">
        <div class="ml-2 w-full mr-5">
            {{-- <img onclick="window.location.href='/'" class="h-full w-auto  object-cover" src="{{asset("storage/images/assets/brand.png")}}" > --}}
            {{-- <input type="text" wire:model.live='filter' class=""> --}}
            <div class="flex items-center rounded-3xl border border-neutral-500 px-2 py-1 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-neutral-500 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                  
                <input type="text" wire:model.live='filter' placeholder="Search..." class="w-full focus:outline-none text-neutral-500">
              </div>
              
        </div>

        @auth
        @isset(Auth()->user()->image)
            <img onclick="window.location.href='/albums'" src="{{Auth()->user()->image}}" alt="User Icon" class="h-8 w-8 rounded-full mr-4">
        @else    
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mr-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        @endisset
    
        @else
        <button class="rounded">Login</button>
        @endauth
        
    </div>

    <div class="my-5 flex justify-center">
        <h1 class="mt-5 text-black text-xs underline font-normal font-['Poppins']"> Explore </h1>
    </div>
    


    <livewire:display-posts :$filter key="{{'child-component-' . now()}}"/>
</div>