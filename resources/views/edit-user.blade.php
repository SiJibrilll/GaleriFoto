<x-layout>
    <div class="flex justify-center">
        <h1 class="text-black text-xs underline font-normal font-['Poppins']"> Edit Profile </h1>
    </div>
    

    <form class="mt-12 mx-2"  action="/posts/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col md:flex-row xl:mx-52 md:gap-16">

            <div class="w-full md:mt-1">
                <livewire:edit-pfp-livewire>
            </div>
    
            <div class="flex flex-col w-full">
                <h1 class="text-black font-normal font-['Poppins'] mt-9 md:mt-0">Title</h1>
                <div class="flex">
                    <textarea class="flex-grow w-full rounded-xl p-2 border border-zinc-200 resize-none" placeholder="Add a title" name="title"></textarea>
                </div>
        
                @error('title')
                    <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                @enderror
            </div>
        </div>    
    </form>

      {{-- flash msg for livewire --}}
        <div id="flash-async" class="fixed bottom-11 xl:bottom-1 left-0 w-full transition-all z-50 duration-300 transform translate-y-full ease-in-out opacity-0 hidden">
            <div class="bg-black mx-5 text-white px-4 py-2 text-center rounded-xl font-bold bg-opacity-70">
                <h1 id="msg" class="text-white text-sm font-['Poppins']">
                test
                </h1>
            </div>
        </div>


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
                flashMessage.classList.add('hidden'); // Slide down animation (after removing visible class)
            }, displayTime);
        };

        document.addEventListener('livewire:init', () => {
            Livewire.on('flash', (event) => {
                
                flash(event.message);
            });

            Livewire.on('changePfp', (event) => {
                pfp = document.getElementById("nav-image");
                pfp.src = event.message
            });
          });

      </script>
    
</x-layout>