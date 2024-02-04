<div class="p-4">
    {{-- // TODO there seems to be some fuck ups in the buttons, they didnt save correctly --}}
    {{-- List all album --}}
    <ul class="space-y-4">
        @foreach ($albums as $album)
        <li wire:key='{{$album->id}}'>
            <div wire:click='saveToAlbum({{$album->id}})' class="flex flex-row items-center">
                @isset($album->posts[0]->images[0]->image)
                <img class="rounded-xl w-14 h-14 object-top object-cover" src="{{asset("storage/images/postImage/" . $album->posts[0]->images[0]->image)}}" />
                @else
                <div class="w-14 h-14 bg-gray-200 rounded-lg"></div>
                @endisset
                <h1 class="text-black text-sm font-bold font-['Poppins'] ml-3">{{$album->title}}</h1>
                
                @if ($album->posts->contains($post->id))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 ml-auto">
                    <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                </svg>                       
                @endif         
            </div>
        </li>
        @endforeach


        {{-- if we have no albums yet --}}
        @if (false) 
            <script>
                let panel = document.querySelector('.album-popup');
                panel.classList.add('max-h-[20vh]'); // decrease panel height
            </script>            
        @endif
        
        
    </ul>


    @if ($saved)
        <script>
            resetModal();
        </script>
    @endif

    <div onclick="showModal('create-album')" class="fixed bottom-0 inset-x-0 px-4 py-3 bg-white flex items-center flex-row max-h-[10vh]">
        <button class="bg-gray-200 rounded-full flex items-center justify-center w-14 h-14 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 font-black">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>              
          </button>
          <h1 class="mb-4 text-black text-sm font-bold font-['Poppins'] ml-3">New album</h1>
    </div>

  {{-- new album modal --}}
  <div class="create-album-popup hidden fixed bottom-0 inset-x-0 sm:inset-0 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform translate-y-full opacity-0">
    <div class="bg-white rounded-s-xl rounded-e-xl shadow-md w-full">
      <button onclick="hideModal('create-album', false)">CANCEL ALBUM CREATION</button>
      <div class="h-[75vh] max-h-[75vh] overflow-y-scroll scroll-smooth">
          <input type="text" wire:model='newAlbum' placeholder="enter name">
          <button wire:click='saveToNew'>Save</button>
          <div class="h-[15vh] max-h-[15vh]">
          </div>
      </div>
    </div>
  </div>
</div>
