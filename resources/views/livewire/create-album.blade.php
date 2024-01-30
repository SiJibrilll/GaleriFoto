<div class="p-4">
    <button onclick="showModal('create-album')">SAVE TO NEW ALBUM</button>
    <button wire:click='unsave'>unsave</button>


    {{-- List all album --}}
    <ul class="space-y-4">
        @foreach ($albums as $album)
        <li wire:key='{{$album->id}}' class="border-b border-gray-200">
            <button wire:click='saveToAlbum({{$album->id}})' class="font-bold"> {{$album->title}} </button>
            
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
