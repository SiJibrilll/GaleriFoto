<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />

    @livewireStyles
    <title>Galeri</title>
</head>
<!-- add before </body> -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<body>
    {{-- mobile topbar --}}
    @if (isset($title) == false)
    <div class="lg:hidden fixed z-50 top-0 left-0 right-0 h-12 bg-white flex items-center justify-between">
        <div class="ml-2 max-w-44">
            <img src="{{asset("storage/images/assets/brand.png" )}}" class="h-full w-auto object-cover" onclick="window.location.href='/'">
        </div>

        @auth
        @isset(Auth()->user()->image)
        <img referrerpolicy="no-referrer" onclick="window.location.href='/users/show/{{Auth()->user()->id}}'"
            src="{{Auth()->user()->image}}" alt="User Icon" class="h-8 w-8 rounded-full mr-4">
        @else
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-8 h-8 mr-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        @endisset

        @else
        <a href="/login"
            class="rounded-2xl mr-4 justify-center w-16 p-2 h-10 flex items-center text-black text-sm font-bold font-['Poppins']">Login</a>
        @endauth

    </div>
    @endif

    {{-- this div is used to give a gap so the content isnt covered by the navbar --}}
    {{-- {{dd($title)}} --}}
    @if (($title ?? null) != 'login')
    <div class="mb-12"></div>

    @endif

    {{
    $slot
    }}


    @if (($title ?? null) != 'login')

    {{-- this div is used to give a gap so the content isnt covered by the navbar --}}
    <div class="mb-12"></div>

    {{-- mobile bottom navbar --}}
    <div class="fixed -bottom-1 left-0 right-0 h-12 bg-white shadow-md flex items-center justify-center xl:hidden">
        <button class="mr-4" onclick="window.location.href='/'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </button>
        <button class="mr-4" onclick="window.location.href='/posts/search'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
        <button class="mr-4" onclick="window.location.href='/posts/create'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
    </div>
    @endif

    @livewireScripts
</body>

</html>