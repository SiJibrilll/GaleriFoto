<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateComments extends Component
{
    public $inputComment = '';
    public Post $post;
    public $comments;

    function store() {
        Comment::create([
            'comment' => $this->inputComment,
            'post_id' => $this->post->id,
            'user_id' => Auth()->user()->id
        ]);

        $this->reset('inputComment');
    }

    function mount($id) {
        $this->post = Post::find($id);
    }

    public function render()
    {
        $this->comments = $this->post->comments->sortByDesc('created_at');

        return view('livewire.create-comments');
    }
}
