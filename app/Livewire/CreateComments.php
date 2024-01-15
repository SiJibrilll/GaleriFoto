<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreateComments extends Component
{

    public Post $post;
    public $comments;

    function mount($id) {
        $this->post = Post::find($id);
    }

    public function render()
    {
        $this->comments = $this->post->comments;

        return view('livewire.create-comments');
    }
}
