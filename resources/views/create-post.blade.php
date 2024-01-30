<x-layout>
    <div class="flex justify-center">
        <h1 class="text-black text-xs underline font-normal font-['Poppins']"> Post </h1>
    </div>
    

    <form class="mt-12 mx-2"  action="/posts/store" method="POST" enctype="multipart/form-data">
        @csrf

        <input class="filepond" type="file" name='image[]' multiple credits='false'>

        <h1 class="text-black font-normal font-['Poppins'] mt-9">Title</h1>
        <div class="flex">
            <textarea class="flex-grow w-full rounded-md border border-zinc-200" name="title"></textarea>
        </div>

        <h1 class="text-black font-normal font-['Poppins'] mt-4">Description</h1>
        <div class="flex">
            <textarea class="flex-grow w-full rounded-md border border-zinc-200" name="description"></textarea>
        </div>

        <h1 class="text-black font-normal font-['Poppins'] mt-4">Tags</h1>
        <div class="flex">
            <textarea class="flex-grow w-full rounded-md border border-zinc-200" name="tags"></textarea>
        </div>

        <div class="flex justify-end mt-6 mb-28">
            <button type="submit" class="w-24 h-9 bg-gray-800 text-white text-xs rounded-3xl font-normal font-['Poppins']">Submit</button>
        </div>
    </form>

    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        // Register the plugin
        FilePond.registerPlugin(FilePondPluginImagePreview);

        // ... FilePond initialisation code here
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
        server: {
            process: '/tmp-image/create',
            fetch: null,
            revert: '/tmp-image/delete',
            headers: {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },
            allowMultiple: true,
        },
    });
    </script>
</x-layout>