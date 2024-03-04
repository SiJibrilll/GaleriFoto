<div>
    @if ($step == 1)
        <div class=" z-50 fixed h-full md:h-auto inset-x-0 sm:inset-0 md:mx-32 xl:mx-[34rem] md:bottom-20 md:top-10 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform">
            <div class="bg-white h-full md:h-auto w-full pt-2 md:rounded-3xl">
                <div class="flex flex-row justify-center items-center mt-28 md:mt-10">
                    <img onclick="window.location.href='/'" src="{{asset('storage/images/assets/logo.png')}}" alt="" class="max-h-10 object-cover">
                    <img onclick="window.location.href='/'" src="{{asset('storage/images/assets/brand.png')}}" alt="" class="max-h-14 object-cover">
                </div>
                <h1 class="text-black text-lg font-bold font-['Poppins'] text-center mt-4 w-full mb-4">Create account</h1>

                <div class="flex flex-col">
                    <div class="flex flex-col items-center px-14 mt-8">
                        <a href="/auth/google/redirect" class="flex justify-center items-center max-w-full rounded-3xl border bg-gray-100 p-2 mb-2 w-full mt-2">
                            <img class="w-7" src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA">
                            <p class="ml-4 text-sm text-black font-['Poppins']">Continue with Google</p>
                        </a>

                        <div class="flex items-center mb-2 w-full">
                            <hr class="h-0 border-b border-solid border border-black-500 grow">
                            <p class="mx-4 text-gray-500">or</p>
                            <hr class="h-0 border-b border-solid border border-black-500 grow">
                        </div>

                        <button wire:click='signUpWithEmail' class="rounded-3xl border bg-blue-500 p-2 mb-2 w-full text-sm text-white font-['Poppins']" type="submit">Sign up with e-mail address</button>

                    </div>
                    
                    <div class="mt-4 flex flex-row justify-center gap-2 pb-4 md:mt-14">
                        <p class="text-sm text-black font-['Poppins']">Have an account? </p>
                        <a href="/login" class="text-sm text-blue-500 font-['Poppins']">Login</a>
                    </div>
                </div> 
            </div>
        </div>        
    @endif
    
    @if ($step == 2)
        <div id="email" class="scale-90 translate-x-5 opacity-0 z-50 fixed h-full md:h-auto inset-x-0 sm:inset-0 md:mx-32 xl:mx-[34rem] md:bottom-20 md:top-10 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform">
            
            @script
            <script> // script for transistion
                setTimeout(() => {
                    let detail = document.getElementById('email');
                    setTimeout(() => {
                        detail.classList.remove('translate-x-5');
                        detail.classList.remove('opacity-0');
                        detail.classList.remove('scale-90');
                    }, 1);
                    
                }, 10);

            </script>
            @endscript
            
            <div class="bg-white h-full md:h-auto w-full pt-2 md:rounded-3xl">
                <div class="flex flex-row justify-center items-center mt-28 md:mt-10">
                    <img onclick="window.location.href='/'" src="{{asset('storage/images/assets/logo.png')}}" alt="" class="max-h-10 object-cover">
                    <img onclick="window.location.href='/'" src="{{asset('storage/images/assets/brand.png')}}" alt="" class="max-h-14 object-cover">
                </div>
                <h1 class="text-black text-lg font-bold font-['Poppins'] text-center mt-4 w-full mb-4">Create </h1>
                <div class="flex flex-col">
                    <div class="flex flex-col items-center px-14 mt-8">
                        <input wire:model='email' type="text" class="rounded-3xl border border-gray-500 p-2 w-full" placeholder="Email">
                        @error('email')
                            <small class="text-red-500 text-xs mt-1 mb-1">{{ $message }}</small>
                        @enderror

                        <input type="password" wire:model='password' class="rounded-3xl border border-gray-500 p-2 mt-4 w-full" placeholder="Password">
                        @error('password')
                            <small class="text-red-500 text-xs mt-1 mb-1">{{ $message }}</small>
                        @enderror
                        <button wire:click='register' class="rounded-3xl border bg-blue-500 p-2 mb-10 w-full mt-8 text-sm text-white font-['Poppins']">Next</button>
                    </div>
                </div> 
            </div>
        </div>        
    @endif
    
    @if ($step == 3)
        <div id="detail"  class="scale-90 translate-x-5 opacity-0 z-50 fixed h-full md:h-auto inset-x-0 sm:inset-0 md:mx-32 xl:mx-96 md:bottom-20 md:top-10 sm:flex sm:items-center sm:justify-center transition-all duration-500 ease-in-out transform">
            @script
            <script> // script for transistion
                setTimeout(() => {
                    let detail = document.getElementById('detail');

                    setTimeout(() => {
                        detail.classList.remove('translate-x-5');
                        detail.classList.remove('opacity-0');
                        detail.classList.remove('scale-90');
                    }, 1);
                    
                }, 10);

            </script>
            @endscript

            <div class="bg-white h-full md:h-auto w-full pt-2 md:rounded-3xl">

                <h1 class="text-black text-lg font-bold font-['Poppins'] text-center mt-4 w-full mb-10">Almost there! </h1>
                <div class="flex flex-col px-6 md:px-0 md:flex-row mb-10">

                    <div class="md:pl-14 md:pr-4 w-full">
                        <livewire:edit-pfp-livewire />
                    </div>

                    <div class="flex flex-col w-full md:pr-14 md:pl-4">
                        <livewire:edit-profile-livewire register='true' />         
                    </div>
                </div>
            </div>
        </div>        
    @endif


    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('register', (event) => {
                //
                setTimeout(() => {
                    let detail = document.getElementById('email');

                    setTimeout(() => {
                        detail.classList.remove('translate-x-5');
                        detail.classList.remove('opacity-0');
                        detail.classList.remove('scale-90');
                    }, 1);
                    
                }, 1);
            });
          });
    </script>

</div>
