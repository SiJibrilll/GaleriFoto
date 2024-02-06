<?php

namespace App\Livewire;

use App\Models\Album;
use App\Models\Album_has;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateAlbum extends Component
{

    #[Locked]
    public Post $post;
    public $closed = false;

    public $newAlbum;
    public $albums;

    function test() {
        $this->closed = false;
    }
    // -- save to new album
    function saveToNew()
    {
        if (!Auth::check()) {
            return;
        }

        // create the album
        $album = Album::create([
            'post_id' => $this->post->id,
            'user_id' => Auth()->user()->id,
            'title' => $this->newAlbum
        ]);

    // attach the pos\ to the album
        $album->posts()->attach($this->post);
        $this->dispatch('closeModal', message: 'Saved to '. $album->title);
    }


    // -- save to existing album
    function saveToAlbum($id)
    {
        if (!Auth::check()) {
            return;
        }

        // -- get the album
        $album = Auth()->user()->albums->where('id', $id)->first();

        // -- if the post is here, then detach the post from album instead
        if ($album->posts->contains($this->post->id)) {
            $this->dispatch('closeModal', message: 'Removed from ' . $album->title);
            $album->posts()->detach($this->post->id);

        } else { // -- if it isnt, then attach
            //get users album where id matches, and attach
            $this->dispatch('closeModal', message: 'Saved to '. $album->title);
            $album->posts()->attach($this->post->id);
        }
        
    }


    public function render()
    {

        $this->albums = Album::where('user_id', '=', Auth()->user()->id)->get()->sortByDesc('created_at');

        return view('livewire.create-album');
    }
}
