<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class HomeLivewire extends Component
{

    public $amount = 10;
    public $loads = 0;
    public $posts = [];

    function loadMore()
    {
       $this->loads++;
    }

    public function render()
    {
       $newPosts = Post::offset($this->amount * $this->loads)->limit($this->amount)->get();

       foreach ($newPosts as $post) {
        array_push($this->posts, [$post->id, $post->images[0]->image]);
       }

        //asset("storage/images/postImage/" . $this->posts[0][1])

    //    dd($this->posts);

        return view('livewire.home-livewire', ['posts' => $this->posts]);
    }
}
