<x-layout>

  {{-- Show the image --}}
  <img class="max-h-72 w-48 object-cover" src="{{asset("storage/images/postImage/" . $post->images[0]->image)}}"
  alt="Image">

  {{-- if theres more than one image, display show more button --}}
  @if (count($post->images) > 1)
  <p>Show More</p>
  @endif

  {{-- general info about the post --}}
  <h1> {{$post->user->username}} </h1>
  <h1> {{$post->title}} </h1>
  <h1> {{$post->description}} </h1>
  {{-- <h1> {{}} </h1> --}}

  {{-- edit the post --}}
  <a href="/posts/edit/{{$post->id}}">edit post</a>



  {{-- gray bg for modals --}}
  <div class="modal-bg hidden fixed inset-0 bg-black bg-opacity-50 transition-opacity duration-300 ease-in-out"
    aria-hidden="true"></div>

  {{-- like button --}}
  @auth
  <livewire:create-like :post='$post' />
  @endauth

  @auth {{-- Abum modal and button --}}

  <button onclick="showModal('album')">SAVE TO ALBUM</button>


  <div
    class="album-popup hidden fixed bottom-0 inset-x-0 sm:inset-0 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform translate-y-full opacity-0">
    <div class="bg-white rounded-s-xl rounded-e-xl shadow-md w-full">
      <button onclick="hideModal('album')">CLOSE ALBUM</button>
      <div class="panel h-[75vh] max-h-[75vh] overflow-y-scroll scroll-smooth">
        <livewire:create-album :post='$post' />
        <div class="h-[15vh] max-h-[15vh]">
        </div>
      </div>
    </div>
  </div>
  @endauth

  {{-- comment modal --}}
  <button onclick="showModal('comment')">OPEN COMMENT</button>
  <div
    class="comment-popup hidden fixed bottom-0 inset-x-0 sm:inset-0 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform translate-y-full opacity-0">
    <div class="bg-white rounded-s-xl rounded-e-xl shadow-md w-full">
      <button onclick="hideModal('comment')">CLOSE COMMENT</button>
      <div class="h-[75vh] max-h-[75vh] overflow-y-scroll scroll-smooth">
        <livewire:create-comments :id='$post->id' />
        <div class="h-[15vh] max-h-[15vh]">
        </div>
      </div>
    </div>
  </div>




  {{-- scripts --}}
  <script>
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

        function resetModal() { //TODO for some reason this wont work
          console.log('hello');
            for (let type of ['comment', 'album', 'create-album']) {
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
        // TODO this wont work somehow
        backdrop.addEventListener('click', resetModal());
  </script>

</x-layout>