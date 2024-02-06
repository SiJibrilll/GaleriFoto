@if (session()->has('message'))
    <div id="flash-message" class="fixed bottom-11 left-0 w-full transition-all z-50 duration-300 transform translate-y-full ease-in-out opacity-0">
        <div class="bg-black mx-5 text-white px-4 py-2 text-center rounded-xl font-bold bg-opacity-70">
            <h1 class="text-white text-sm font-['Poppins']">
                {{session('message')}}
            </h1>

        </div>
  </div>

  <script>
    const flashMessage = document.getElementById('flash-message');
    const displayTime = 3000; // Adjust this to your desired display time in milliseconds

    window.addEventListener('DOMContentLoaded', () => {
        flashMessage.classList.remove('translate-y-full');
        flashMessage.classList.remove('opacity-0');

        setTimeout(() => {
            flashMessage.classList.add('opacity-0'); // Slide down animation (after removing visible class)
            flashMessage.classList.add('translate-y-full'); // Slide down animation (after removing visible class)
        }, displayTime);
    });

    </script>
@endif