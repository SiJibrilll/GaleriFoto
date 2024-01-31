<x-layout>
    <div class="my-5 flex justify-center">
        <h1 class="text-black text-xs underline font-normal font-['Poppins']"> {{$title}} </h1>
    </div>
    
    <livewire:display-posts :album='$album' />
</x-layout>