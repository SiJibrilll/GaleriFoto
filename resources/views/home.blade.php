<x-layout>
<h1>beranda</h1>
@auth
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
@else
    <a href="/login">Login</a>    
@endauth

<p> {{isset($album)?: ''}} </p>

<livewire:display-posts />
</x-layout>