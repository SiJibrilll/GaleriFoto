<div>
    <h1 class="text-black font-bold text-xl font-['Poppins'] mt-9 md:mt-0">Username</h1>
    <div class="flex">
        <textarea class="flex-grow w-full rounded-xl p-2 border border-zinc-200 resize-none" placeholder="Add a title" wire:model='username'>{{$username}}</textarea>
    </div>
    @error('username')
        <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
    @enderror

    <div class="flex justify-end mt-6 mb-28 md:mt-8">
        <button wire:click='save' class="w-24 h-9 bg-gray-800 text-white text-xs rounded-3xl font-normal font-['Poppins']">Save</button>
    </div>

</div>