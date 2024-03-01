<x-auth-layout>
        <div
            class=" z-50 fixed bottom-0 inset-x-0 sm:inset-0 md:mx-32 xl:mx-[34rem] md:bottom-20 md:top-10 sm:flex sm:items-center sm:justify-center transition-all duration-300 ease-in-out transform">
            <div class="bg-gradient-to-t from-white md:bg-white from-90% w-full pt-2 md:rounded-3xl">
                <div
                    class="bg-gray-200 p-4 rounded-full overflow-hidden  absolute top-0 md:top-28 xl:top-0 left-1/2 transform translate-x-[-50%]">
                    <img onclick="window.location.href='/'" src="{{asset('storage/images/assets/logo.png')}}" alt=""
                        class="max-h-20 object-cover">
                </div>
                
                <div class="flex flex-col justify-between">
                    <h1 class="text-black text-lg font-bold font-['Poppins'] mt-28 text-center w-full mb-4">Explore,
                        create, and
                        connect</h1>
                    <div class="h-[50vh] max-h-[50vh] justify-between flex flex-col">
                        <form class="flex flex-col items-center px-14 mt-8" action="/authenticate" method="POST">
                            @csrf
                            <input type="text" name="email" class="rounded-3xl border border-gray-500 p-2 mb-2 w-full"
                                placeholder="Email">
                            <input type="password" name="password"
                                class="rounded-3xl border border-gray-500 p-2 mb-2 w-full" placeholder="Password">

                            <button
                                class="rounded-3xl border bg-blue-500 p-2 mb-2 w-full mt-8 text-sm text-white font-['Poppins']"
                                type="submit">Login</button>

                                <div class="flex items-center mb-2 w-full">
                                    <hr class="h-0 border-b border-solid border border-black-500 grow">
                                    <p class="mx-4 text-gray-500">or</p>
                                    <hr class="h-0 border-b border-solid border border-black-500 grow">
                                </div>

                            <a href="/auth/google/redirect"
                                class="flex justify-center items-center max-w-full rounded-3xl border bg-gray-100 p-2 mb-2 w-full mt-2">
                                <img class="w-7"
                                    src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA">
                                <p class="ml-4 text-sm text-black font-['Poppins']">Continue with Google</p>
                            </a>
                        </form>

                        <div class="flex flex-row justify-center gap-2 pb-4">
                            <p class="text-sm text-black font-['Poppins']">Dont have an account? </p>
                            <a href="/register" class="text-sm text-blue-500 font-['Poppins']"> Sign up</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    {{-- <img src="" alt=""> --}}
</x-auth-layout>