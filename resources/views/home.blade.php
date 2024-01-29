<x-layout>
{{-- @auth
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
@else
    <a href="/login">Login</a>    
@endauth --}}

<div class="my-5 flex justify-center">
    <h1 class="text-black text-xs underline font-normal font-['Poppins']"> Home </h1>
</div>
<livewire:display-posts />

</x-layout>