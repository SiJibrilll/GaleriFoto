<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateLike extends Component
{

    public $isLiked;

    public Post $post;

    function like() {
        if (!Auth::check()) { // check for authentication
            return;
        }

        if ($this->isLiked) { // if user already liked the post, then detach the relation
            $this->post->likes()->detach(Auth()->user()->id);
            $this->reset('isLiked');
            return;
        }

        // if user havent liked the post, create the relation
        $this->post->likes()->attach(Auth()->user()->id);
        $this->reset('isLiked');
    }

    public function render()
    {
        $this->isLiked = Post::find($this->post->id)->likes->contains(Auth()->user()->id);
        

        return view('livewire.create-like');
    }
}
