<div class="p-4">
        <h1>Comments </h1>

        {{-- List all comments --}}
        <ul class="space-y-4">
            @foreach ($comments as $comment)
            <li wire:key='{{$comment->id}}' class="border-b border-gray-200">
                <p class="font-bold"> {{$comment->user->username}} </p>
                <p class="text-sm">{{$comment->comment}} </p>
            </li>
            @endforeach
            
        </ul>

    {{-- Comment Input Fields --}}
    <div class="fixed bottom-0 inset-x-0 px-4 py-3 bg-gray-50 shadow-md flex items-center justify-between max-h-[25vh]">
        <input wire:model='inputComment' type="text" class="w-full border-none rounded-lg px-3 py-2 bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Write your comment...">
        <button wire:click="store" type="button" class="inline-flex items-center px-4 py-2 text-base font-semibold text-blue-600 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          Post Comment
        </button>
      </div>
</div>
