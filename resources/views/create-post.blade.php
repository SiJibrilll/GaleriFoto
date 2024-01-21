<x-layout>
    <form action="/posts/store" method="POST" enctype="multipart/form-data">
        @csrf

        <input class="filepond" type="file" name='image[]' multiple credits='false'>

        <h1>Title</h1>
        <textarea name="title"></textarea>
        <h1>Description</h1>
        <textarea name="description"></textarea>
        <h1>Tags</h1>
        <textarea name="tags"></textarea>
        <button type="submit" class="">Submit</button>
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