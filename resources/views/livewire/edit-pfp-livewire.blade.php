<div>    
    
    <div class="flex items-center justify-center w-full">
        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div wire:loading.remove  class="flex flex-col items-center justify-center pt-5 pb-6">
                <img class="w-32 h-32 object-cover rounded-full mb-2" src="{{$image}}" alt="Rounded avatar">
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload new picture</span></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">(square image recommended)</p>
            </div>
            <input id="dropzone-file" type="file" class="hidden" wire:model='newImage'/>

            <div wire:loading wire:target="newImage">Uploading...</div>
        </label>
    </div> 

    <script>

    </script>


    <div>
        @error('newImage') <span class="text-red-400">make sure the file uploaded is an image</span> @enderror 
    </div>
</div>
