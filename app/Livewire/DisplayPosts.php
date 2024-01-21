<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class DisplayPosts extends Component
{
    public $filter;

    public $amount = 10;
    public $loads = 0;
    public $posts = [];

    function loadMore()
    {
       $this->loads++;
    }

    public function render()
    {
       if ($this->filter == null) { // if there were no filters applied, then show newest posts
            $newPosts =  Post::orderBy('created_at', 'desc')->offset($this->amount * $this->loads)->limit($this->amount)->get();
           
        } else { // if there were filters, then query accordingly
           $newPosts = Post::where('title', 'like', '%'. $this->filter . '%')->orWhere('description', 'like', '%'. $this->filter . '%')
           ->orWhere('tags', 'like', '%'. $this->filter . '%')->offset($this->amount * $this->loads)->limit($this->amount)->get();
       }

       // -- quarry all of the post's image
       foreach ($newPosts as $post) {
        array_push($this->posts, [$post->id, $post->images[0]->image]);
       }


        return view('livewire.display-posts', ['posts' => $this->posts]);
    }
}
