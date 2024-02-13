<div>
    {{-- mobile and tablet bar --}}
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
            <img referrerpolicy="no-referrer" onclick="window.location.href='/users/show/{{Auth()->user()->id}}'" src="{{Auth()->user()->image}}" alt="User Icon" class="h-8 w-8 rounded-full mr-4">
        @else    
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14 mr-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        @endisset
    
        @else
        <a href="/login" class="rounded-2xl mr-4 justify-center w-16 p-2 h-10 flex items-center text-black text-sm font-bold font-['Poppins']">Login</a>
        @endauth
        
    </div>

    {{-- desktop bar --}}
    <div class="hidden xl:flex fixed z-10 top-0 left-0 right-0 h-12 bg-white flex-row items-center justify-between xl:h-20">
        <div style="cursor: pointer;" class="ml-2 max-w-44 xl:max-w-52">
            <img src="{{asset("storage/images/assets/brand.png" )}}" class="h-full w-auto object-cover" onclick="window.location.href='/'">
        </div>

        <form action="/posts/search" method="POST" class="grow w-full mx-24 hidden xl:block">
            @csrf
            @method('GET')
            <div class="flex items-center rounded-3xl border border-neutral-500 px-2 py-1 w-full hover:bg-slate-100 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-neutral-500 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                  
                <input name="filter" type="text" placeholder="Search..." class="w-full focus:outline-none text-neutral-500 bg-transparent">
                <input type="submit" style="display: none" />
            </div>
        </form>

        <a href="/posts/create" class="hidden items-center justify-center rounded-3xl border bg-gray-800 hover:bg-black text-white h-10 text-sm px-2 py-1 w-full font-['Poppins'] font-bold grow-0 max-w-44 mr-6 xl:flex">Create post</a>
        @auth
            @isset(Auth()->user()->image)
                <img style="cursor: pointer;" referrerpolicy="no-referrer" onclick="window.location.href='/users/show/{{Auth()->user()->id}}'"
                    src="{{Auth()->user()->image}}" alt="User Icon" class="h-8 w-8 rounded-full mr-4 xl:w-10 xl:h-10 hover:brightness-90 transition-all">
            @else
                <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-8 h-8 mr-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            @endisset

        @else
            <a href="/login"
                class="rounded-2xl mr-4 justify-center w-16 p-2 h-10 flex items-center text-black text-sm font-bold font-['Poppins']">Login</a>
        @endauth

    </div>

    <div class="my-5 flex justify-center">
        <h1 class="mt-5 text-black text-xs underline font-normal font-['Poppins']"> Explore </h1>
    </div>
    


    <livewire:display-posts :$filter key="{{'child-component-' . now()}}"/>
</div>
