<div class="p-4 ">
  <h1 class="text-black text-xs font-bold font-['Poppins'] mb-3">{{count($comments)}} Comments</h1>
  <hr class="h-[1px] bg-gray-200 w-full mb-3">

        {{-- List all comments --}}
        <ul class="space-y-4">
            @foreach ($comments as $comment)
            <li wire:key='{{$comment->id}}' class="border-b border-gray-200 flex flex-row justify-between items-center">
              
                {{-- show commenter pfp --}}
                @isset($comment->user->image)
                    <div class="flex flex-row items-center">
                      <img onclick="window.location.href='/albums'" src="{{$comment->user->image}}" alt="User Icon" class="h-8 w-8 rounded-full mr-3 ml-1">
                      <div class="flex flex-col">
                        <h1 class="text-black font-bold font-['Poppins']"> {{$comment->user->username}} </h1>
                        <p class="text-sm">{{$comment->comment}} </p>
                      </div>
                    </div>
                @else   {{-- if commenter does not have an image, just use a placeholder--}}
                    <div class="flex flex-row items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mr-2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                      <div class="flex flex-col">
                        <h1 class="text-black font-bold font-['Poppins']"> {{$comment->user->username}} </h1>
                        <p class="text-sm">{{$comment->comment}} </p>
                      </div>                    
                    </div>
                @endisset
                @auth
                  {{-- only show delete button if comment --}}
                  @if (Auth()->user()->id == $comment->user->id)
                    <svg style="cursor: pointer;" wire:click='delete({{$comment->id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>                
                  @endif
                    
                @endauth
            </li>
            @endforeach
            
        </ul>

        {{-- // TODO this breaks on tablets, will fix on future builds --}}
    {{-- Comment Input Fields --}}
    <div class="fixed -bottom-1 md:bottom-3 inset-x-0 px-4 py-3 border-t bg-gray-50 flex items-center justify-between max-h-[15vh] md:rounded-b-3xl">
        <input wire:keydown.enter="store" wire:model='inputComment' type="text" class="w-full border rounded-3xl px-3 py-2 bg-gray-100 " placeholder="Write a comment...">
        <svg style="cursor: pointer;" wire:click="store" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-gray-200 ml-4">
          <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
        </svg>
      </div>

      
</div>
