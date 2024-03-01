<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="x-icon" href="{{asset("storage/images/assets/logo.png" )}}">
    @vite('resources/css/app.css')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />

    @livewireStyles
    <title>Artcana</title>
</head>
<!-- add before </body> -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<body class="bg-repeat bg-cover md:bg-gray-600 md:bg-blend-overlay h-screen overflow-hidden {{$title == 'register' ? 'bg-white bg-blend-overlay' : ''}}" style='background-image: url("{{asset("storage/images/assets/Img.png")}}")'>
    {{-- this div is used to give a gap so the content isnt covered by the navbar --}}
    {{-- {{dd($title)}} --}}

    {{
    $slot
    }}


    
    @livewireScripts
</body>

</html>