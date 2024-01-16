<?php

namespace App\Livewire;

use App\Models\Album;
use App\Models\Album_has;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateAlbum extends Component
{
    public $newAlbum;
    public $saved = false;
    public Post $post;
    public $albums;

    function saveToNew() {
        if (!Auth::check()) {
            return;
        }

        $album = Album::create([
            'post_id' => $this->post->id,
            'user_id' => Auth()->user()->id,
            'title' => $this->newAlbum
        ]);

        Album_has::create([
            'post_id' => $this->post->id,
            'album_id' => $album->id
        ]);

        $this->saved = true;
    }

    public function render()
    {   

        $this->albums = Auth()->user()->albums->sortByDesc('created_at');

        return view('livewire.create-album');
    }
}
