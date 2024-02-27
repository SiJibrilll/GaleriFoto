<x-layout>
    {{-- mobile topbar --}}

    <div class=" fixed z-10 top-0 left-0 right-0 h-12 bg-white flex flex-row items-center justify-between xl:h-20">
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
        
        <button onclick="showModal('setting')">
          <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 xl:w-10 xl:h-10 mr-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
          </svg>
        </button>
    </div>
   
  


    <div class="my-5 flex flex-col items-center justify-center w-full h-auto mt-16">
        @isset($user->image)
          <img referrerpolicy="no-referrer" class="w-full h-full max-w-32 rounded-full object-cover" src="{{$user->image}}">
        @else 
          <svg onclick="window.location.href='/users/show/{{Auth()->user()->id}}'" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-full h-full max-w-32 rounded-full">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>           
        @endisset
        <h1 class="text-neutral-700 mt-4 text-2xl font-black font-['Poppins']">{{$user->username}}</h1>
    </div>
    <livewire:profile-livewire user='{{$user->id}}'/>

    {{-- gray bg for modals --}}
  <div onclick="resetModal()" class="modal-bg hidden fixed z-50 inset-0 bg-black bg-opacity-50 transition-opacity duration-300 ease-in-out"
  aria-hidden="true"></div>

    {{-- profile settings modal --}}
    <div
    class="setting-popup z-50 hidden fixed bottom-0 sm:bottom-40 sm:top-40 sm:mx-32 xl:bottom-20 xl:top-20 xl:mx-96 inset-x-0 sm:inset-0 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform translate-y-full opacity-0">
    <div class="bg-white rounded-t-3xl md:rounded-3xl shadow-md w-full pt-2">
      <div  class="relative flex items-center justify-between px-4 py-2">
        <button onclick="hideModal('setting')" class="absolute top-1/2 left-4 -translate-y-1/2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        <span class="text-center font-medium mx-auto">Settings</span>
      </div>
      <div class="h-[75vh] max-h-[75vh] md:max-h-[50vh]">
        {{-- content here --}}
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="mt-10 ml-3 text-red-600 text-lg font-bold font-['Poppins'] mb-3">Logout</button>
        </form>

        <button onclick="window.location.href='/users/edit'" class="ml-3 text-lg font-bold font-['Poppins'] mb-3 cursor-pointer">Edit profile</button>
        <div class="h-[15vh] max-h-[15vh]">
        </div>
      </div>
    </div>
  </div>

  <script>
    const backdrop = document.querySelector('.modal-bg');
        const body = document.body;
        const settingModal = document.querySelector('.setting-popup');

        // -- comment modal
        function showModal(type) {
          let modal = document.querySelector('.' + type + '-popup');
            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
            setTimeout(() => {
                body.classList.add('overflow-hidden'); // Disable scrolling on the body
                backdrop.classList.remove('opacity-0');
                modal.classList.remove('opacity-0');
                modal.classList.remove('translate-y-full');
                
        }, 100);
        }

        // hide the modal
        function hideModal(type, eraseBG = true) {
          let modal = document.querySelector('.' + type + '-popup');
          body.classList.remove('overflow-hidden'); // Re-enable scrolling on the body
          modal.classList.add('opacity-0');
          modal.classList.add('translate-y-full');
          if (eraseBG) {
            backdrop.classList.add('opacity-0');
            backdrop.classList.add('hidden');
          }          
        }

        function resetModal() { 
            for (let type of ['setting']) {
              let modal = document.querySelector('.' + type + '-popup');
              body.classList.remove('overflow-hidden'); // Re-enable scrolling on the body
              backdrop.classList.add('opacity-0');
              backdrop.classList.add('hidden');
              modal.classList.add('opacity-0');
              modal.classList.add('translate-y-full');

            }
        }

        
        // ============ settings to preload ================
        settingModal.addEventListener('click', (event) => {
        // Prevent clicks inside the modal from closing it
        event.stopPropagation();
        });
    
  </script>
</x-layout>