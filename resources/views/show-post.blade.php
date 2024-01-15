<x-layout>

    <img class="max-h-72 w-48 object-cover" src="{{asset("storage/images/postImage/" . $post->images[0]->image)}}" alt="Image">

    @if (count($post->images) > 1) 
        <p>Show More</p>
    @endif

    <h1> {{$post->user->username}} </h1>
    

    <h1> {{$post->title}} </h1>
    <h1> {{$post->description}} </h1>

</x-layout>