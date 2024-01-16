<x-layout>

    <img class="max-h-72 w-48 object-cover" src="{{asset("storage/images/postImage/" . $post->images[0]->image)}}" alt="Image">

    @if (count($post->images) > 1) 
        <p>Show More</p>
    @endif

    <h1> {{$post->user->username}} </h1>
    

    <h1> {{$post->title}} </h1>
    <h1> {{$post->description}} </h1>

    <a href="/posts/edit/{{$post->id}}">edit post</a>

    <div class="modal-bg hidden fixed inset-0 bg-black bg-opacity-50 transition-opacity duration-300 ease-in-out" aria-hidden="true"></div>

    {{-- <div class="album-popup hidden fixed bottom-0 inset-x-0 sm:inset-0 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform translate-y-full opacity-0">
        <div class="bg-white rounded-s-xl rounded-e-xl shadow-md overflow-y-scroll w-full max-h-[75vh]">            
              
        </div>
    </div> --}}

    {{-- comment modal --}}
    <div class="comment-popup hidden fixed bottom-0 inset-x-0 sm:inset-0 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform translate-y-full opacity-0">
      <div class="bg-white rounded-s-xl rounded-e-xl shadow-md w-full">
        <button onclick="hideModal('comment')">CLOSE COMMENT</button>
        <div class="h-[75vh] max-h-[75vh] overflow-y-scroll scroll-smooth">
            <livewire:create-comments :id='$post->id' />    
            <div class="h-[15vh] max-h-[15vh]">
            </div>
        </div>
      </div>
    </div>
    

      <button onclick="showModal('comment')">OPEN</button>

      <script>
        const backdrop = document.querySelector('.modal-bg');
        const body = document.body;
        const modal = document.querySelector('.comment-popup');

        // -- comment modal
        function showModal() {
            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
            setTimeout(() => {
                body.classList.add('overflow-hidden'); // Disable scrolling on the body
                backdrop.classList.remove('opacity-0');
                modal.classList.remove('opacity-0');
                modal.classList.remove('translate-y-full');
                
        }, 100);
        }

        function hideModal() {
        body.classList.remove('overflow-hidden'); // Re-enable scrolling on the body
        backdrop.classList.add('opacity-0');
        backdrop.classList.add('hidden');
        modal.classList.add('opacity-0');
        modal.classList.add('translate-y-full');
        }


        modal.addEventListener('click', (event) => {
        // Prevent clicks inside the modal from closing it
        event.stopPropagation();
        });

        backdrop.addEventListener('click', hideModal);
    </script>

</x-layout>