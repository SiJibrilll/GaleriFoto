<x-layout>
    <h1 class='font-bold'> Login page </h1>
    <form action="/authenticate" method="POST">
        @csrf
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Submit</button>
    </form>

    <a href="/auth/google/redirect" class="flex justify-center items-center max-w-full mt-4">
        <img class="w-7"
            src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA">
        <p class="ml-4 text-lg">Masuk dengan Google</p>
    </a>
</x-layout>