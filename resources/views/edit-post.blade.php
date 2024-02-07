<x-layout>
    <div class="flex justify-center">
        <h1 class="text-black text-xs underline font-normal font-['Poppins']">Edit post</h1>
    </div>

    <form id="myform" class="mt-12 mx-2" action="/posts/update/{{$post->id}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input class="filepond" type="file" name='image[]' multiple credits='false'>

        @error('image')
            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
        @enderror


        <h1 class="text-black font-normal font-['Poppins'] mt-9">Title</h1>
        <div class="flex">
            <textarea placeholder="Add a title" class="flex-grow w-full rounded-md border border-zinc-200" name="title">{{null == old('title')? $post->title : old('title')}}</textarea>
        </div>

        @error('title')
            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
        @enderror


        <h1 class="text-black font-normal font-['Poppins'] mt-4">Description</h1>
        <div class="flex">
            <textarea placeholder="Add more details" class="flex-grow w-full rounded-md border border-zinc-200" name="description">{{null == old('description')? $post->description : old('description')}}</textarea>
        </div>

        <h1 class="text-black font-normal font-['Poppins'] mt-4">Tags</h1>
        <div class="flex">
            <textarea placeholder="Seperate tags with spaces" class="flex-grow w-full rounded-md border border-zinc-200" name="tags">@if(old('tags') != null){{old('tags')}}@else @foreach ($post->tags as $tag){{$tag->name}}@endforeach @endif</textarea>
        </div>

    </form>

    <div class="flex justify-end mt-6 mx-2 items-center mb-28">
        <form action="/posts/delete/{{$post->id}}" method="POST">
            @csrf
            <button type="submit" class="mr-4 w-24 h-9 bg-red-500 text-white text-xs rounded-3xl font-normal font-['Poppins']">Delete post</button>
        </form>
        <button type="submit" form="myform" class="w-24 h-9 bg-gray-800 text-white text-xs rounded-3xl font-normal font-['Poppins']">Update</button>
    </div>


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
            pond.addFiles(url + '/' + image.image)
        });

    </script>
</x-layout>