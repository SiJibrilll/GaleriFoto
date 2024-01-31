<x-layout>

    <div class="my-5 flex flex-col items-center justify-center w-full h-auto mt-16">
        <img referrerpolicy="no-referrer" class="w-full h-full max-w-32 rounded-full object-cover" src="{{$user->image}}">
        <h1 class="text-neutral-700 mt-4 text-2xl font-black font-['Poppins']">{{$user->username}}</h1>
    </div>
    <livewire:profile-livewire user='{{$user->id}}'/>
</x-layout>