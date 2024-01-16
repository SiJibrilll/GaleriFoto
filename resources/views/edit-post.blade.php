<x-layout>
    <form action="/posts/update" method="POST" enctype="multipart/form-data">
        @csrf

        <input class="filepond" type="file" name='image[]' multiple credits='false'>

        <h1>Title</h1>
        <input type="text" name="title" value="{{null == old('title')? $post->title : old('title')}}">
        <h1>Description</h1>
        <input type="text" name="description" value="{{null == old('description')? $post->description : old('description')}}">
        <h1>Tags</h1>
        <input type="text" name="tags" value="{{null == old('tags')? $post->tags : old('tags')}}">
        <button type="submit" class="">Submit</button>
    </form>

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
                revert: '/tmp-image/delete',
                headers: {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                allowMultiple: true,
            },
        });

        let images = @json($post->images);
        let url = @json(asset("storage/images/postImage/"));

        images.forEach(image => {
            pond.addFile(url + '/' + image.image)
        });

    </script>
</x-layout>