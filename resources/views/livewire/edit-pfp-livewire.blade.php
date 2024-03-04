<div>    
    
    <div class="flex items-center justify-center w-full">
        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div wire:loading.remove  class="flex flex-col items-center justify-center pt-5 pb-6">
                @isset($image)
                    <img class="w-32 h-32 object-cover rounded-full mb-2" src="{{$image}}" alt="Rounded avatar">
                @else
                    <svg style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-32 h-32 mb-2 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                @endisset
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload new picture</span></p>
                <p class="text-xs text-gray-500 dark:text-gray-400">(square image recommended)</p>
            </div>
            <input id="dropzone-file" type="file" class="hidden" wire:model='newImage'/>

            <div wire:loading wire:target="newImage">Uploading...</div>
        </label>
    </div> 

    <div>
        @error('newImage') <span class="text-red-400">make sure the file uploaded is an image</span> @enderror 
    </div>
</div>
