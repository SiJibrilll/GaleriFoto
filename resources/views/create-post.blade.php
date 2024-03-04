<x-layout>
    <div class="flex justify-center">
        <h1 class="text-black text-xs underline font-normal font-['Poppins']"> Post </h1>
    </div>
    

    <form class="mt-12 mx-2"  action="/posts/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col md:flex-row xl:mx-52 md:gap-16">

            <div class="w-full md:mt-1">
                <input class="filepond" type="file" name='image[]' multiple credits='false' >                
                @error('image')
                    <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                @enderror
            </div>
    
            <div class="flex flex-col w-full">
                <h1 class="text-black font-normal font-['Poppins'] mt-9 md:mt-0">Title</h1>
                <div class="flex">
                    <textarea class="flex-grow w-full rounded-xl p-2 border border-zinc-200 resize-none" placeholder="Add a title" name="title"></textarea>
                </div>
        
                @error('title')
                    <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                @enderror
        
                <h1 class="text-black font-normal font-['Poppins'] mt-4 md:mt-8" >Description</h1>
                <div class="flex">
                    <textarea class="flex-grow w-full rounded-xl p-2 border border-zinc-200 resize-none md:h-52" placeholder="Add more details" name="description"></textarea>
                </div>
        
                <h1 class="text-black font-normal font-['Poppins'] mt-4 md:mt-8">Tags</h1>
                <div class="flex">
                    <textarea class="flex-grow w-full rounded-xl p-2 border border-zinc-200 resize-none" name="tags" placeholder="Seperate tags with spaces"></textarea>
                </div>
        
                <div class="flex justify-end mt-6 mb-28 md:mt-8">
                    <button type="submit" class="w-24 h-9 bg-gray-800 text-white text-xs rounded-3xl font-normal font-['Poppins']">Submit</button>
                </div>
            </div>
        </div>    
    </form>

    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        // Register the plugin
        FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);

        // ... FilePond initialisation code here
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: ['image/*'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    // Do custom type detection here and return with promise

                    resolve(type);
                }),
        });

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