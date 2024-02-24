<x-layout>
  <div class="xl:mx-64">
    {{-- Show the image --}}
    @if (count($post->images) > 1) {{-- if theres more than one image, display show more button --}}
        <div class="relative flex justify-center h-full">
          <img class="w-full max-h-72 object-top object-cover xl:max-w-xl xl:mx-auto xl:max-h-96" src="{{asset("storage/images/postImage/" . $post->images[0]->image)}}"
          alt="Image">
          <button onclick="window.location.href='/posts/images/show/{{$post->id}}'" class="absolute bottom-1 left-0 right-0 mx-32 text-xs font-normal font-['Poppins'] bg-black px-4 py-2 text-white text-center rounded-2xl ">Show More</button>
          <button onclick="window.history.back()" class="absolute top-0 left-0 m-4 bg-black bg-opacity-75 p-2 rounded-full text-white hover:bg-opacity-75 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
        </div>
    @else
    <div class="relative flex justify-center h-full">
        <img class="max-w-auto h-auto object-cover" src="{{asset("storage/images/postImage/" . $post->images[0]->image)}}"
        alt="Image">
        <button onclick="window.history.back()" class="absolute top-0 left-0 m-4 bg-black bg-opacity-75 p-2 rounded-full text-white hover:bg-opacity-75 transition ease-in-out duration-150">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>    
    </div>
    @endif

    <div class="flex flex-row justify-between mx-3 mt-8 mb-5">
      {{-- show poster username and picture --}}
        @isset($post->user->image)
            <div class="flex flex-row items-center">
              <img src="{{$post->user->image}}" alt="User Icon" class="h-8 w-8 rounded-full mr-4">
              <h1 class="text-black text-xs font-semibold font-['Poppins']"> {{$post->user->username}} </h1>
            </div>
        @else   {{-- if poster does not have an image, just use a placeholder--}}
            <div class="flex flex-row items-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mr-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
              <h1 class="text-black text-xs font-semibold font-['Poppins']"> {{$post->user->username}} </h1>
            </div>
        @endisset

        @auth
          <div class="ml-auto flex flex-row justify-end items-center">
              @if (Auth()->user()->id == $post->user->id || Auth()->user()->hasRole('admin')) {{-- if logged in user is the post owner, then show edit button --}}
                <div style="cursor: pointer;" class="bg-gray-200 rounded-3xl w-10 h-10 p-2">
                    <svg onclick="window.location.href='/posts/edit/{{$post->id}}'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                </div>
              @endif            

            {{-- like button --}}
            <livewire:create-like :post='$post' />
            
            <button class="rounded-3xl p-2 h-10 w-24 bg-gray-200 text-black text-xs font-normal font-['Poppins']" onclick="showModal('album')">Save</button>

          </div>          
        @endauth

    </div>



    {{-- general info about the post --}}
    <div class="ml-16 mb-3">
        <h1 class="text-black text-lg font-bold font-['Poppins']"> {{$post->title}} </h1>
        <h1 class="text-black text-xs font-light font-['Poppins']"> {{$post->description}} </h1>
    </div>

    <hr class="h-[1px] bg-gray-200 w-full mb-3">
    
    {{-- comment button --}}
    <button class="ml-3 text-black text-xs font-bold font-['Poppins'] mb-3" onclick="showModal('comment')">See Comments</button>
    
    <hr class="h-[1px] bg-gray-200 w-full mb-4">

  </div>
  <h1 class="ml-3 text-black text-xs font-normal font-['Poppins'] mb-4 md:text-center md:mt-14 md:underline">More to Explore</h1>

  {{-- gray bg for modals --}}
  <div onclick="resetModal()" class="modal-bg hidden fixed z-50 inset-0 bg-black bg-opacity-50 transition-opacity duration-300 ease-in-out"
    aria-hidden="true"></div>

  

  @auth {{-- Abum modal --}}
  <div
    class="album-popup hidden z-50 fixed bottom-0 md:bottom-20 md:top-20 sm:mx-32 xl:mx-96 inset-x-0 sm:inset-0 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform translate-y-full opacity-0">
    <div class="bg-white rounded-t-3xl shadow-md w-full pt-2 md:rounded-3xl">
      <div  class="relative flex items-center justify-between px-4 py-2">
        <button onclick="hideModal('album')" class="absolute top-1/2 left-4 -translate-y-1/2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        <span class="text-center font-medium mx-auto">Save to album</span>
      </div>
      <livewire:create-album :post='$post' />
    </div>
  </div>
  @endauth

  {{-- comment modal --}}
  <div
    class="comment-popup z-50 hidden fixed bottom-0 md:bottom-20 md:top-20 md:mx-20 xl:mx-96 inset-x-0 sm:inset-0 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform translate-y-full opacity-0">
    <div class="bg-white rounded-t-3xl shadow-md w-full pt-2 md:rounded-3xl">
      <div  class="relative flex items-center justify-between px-4 py-2">
        <button onclick="hideModal('comment')" class="absolute top-1/2 left-4 -translate-y-1/2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        <span class="text-center font-medium mx-auto">Comments</span>
      </div>
      <livewire:create-comments :id='$post->id' />
    </div>
  </div>
  <x-flash-message />

  {{-- flash msg for livewire --}}
  <div id="flash-async" class="fixed bottom-11 xl:bottom-1 left-0 w-full transition-all z-50 duration-300 transform translate-y-full ease-in-out opacity-0 hidden">
    <div class="bg-black mx-5 text-white px-4 py-2 text-center rounded-xl font-bold bg-opacity-70">
        <h1 id="msg" class="text-white text-sm font-['Poppins']">
          test
        </h1>
      </div>
  </div>


  {{-- display more post --}}
  <livewire:display-posts />



  {{-- scripts --}}
  <script> // async flash msg script
    const flashMessage = document.getElementById('flash-async');
    const displayTime = 3000; // Adjust this to your desired display time in milliseconds

    function flash(message) {
        flashMessage.querySelector("h1#msg").textContent = message;
        flashMessage.classList.remove('hidden');

        setTimeout(() => {
          flashMessage.classList.remove('translate-y-full');
          flashMessage.classList.remove('opacity-0');
        }, 10);

        setTimeout(() => {
            flashMessage.classList.add('opacity-0'); // Slide down animation (after removing visible class)
            flashMessage.classList.add('translate-y-full'); // Slide down animation (after removing visible class)
        }, displayTime);
    };
  </script>


  <script> // modal scripts
    const backdrop = document.querySelector('.modal-bg');
        const body = document.body;
        const commentModal = document.querySelector('.comment-popup');
        const albumModal = document.querySelector('.album-popup');

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
          for (let type of ['comment', 'album', 'create-album']) {
              console.log('hello');
              let modal = document.querySelector('.' + type + '-popup');
              body.classList.remove('overflow-hidden'); // Re-enable scrolling on the body
              backdrop.classList.add('opacity-0');
              backdrop.classList.add('hidden');
              modal.classList.add('opacity-0');
              modal.classList.add('translate-y-full');

            }
        }

        // ============ settings to preload ================
        commentModal.addEventListener('click', (event) => {
        // Prevent clicks inside the modal from closing it
        event.stopPropagation();
        });
        
        albumModal.addEventListener('click', (event) => {
        // Prevent clicks inside the modal from closing it
        event.stopPropagation();
        });

        document.querySelector('.create-album-popup').addEventListener('click', (event) => {
        // Prevent clicks inside the modal from closing it
        event.stopPropagation();
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('closeModal', (event) => {
                //
                resetModal();
                flash(event.message);
            });
          });
  </script>

</x-layout>