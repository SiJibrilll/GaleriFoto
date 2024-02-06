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
    public $saved = false;

    public $newAlbum;
    public Post $post;
    public $albums;


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

        // attach the post to the album
        $album->posts()->attach($this->post);
        $this->saved = true;
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
            $album->posts()->detach($this->post->id);

        } else { // -- if it isnt, then attach
            //get users album where id matches, and attach
            $album->posts()->attach($this->post->id);
        }
        
        $this->saved = true;
    }


    public function render()
    {

        $this->albums = Album::where('user_id', '=', Auth()->user()->id)->get()->sortByDesc('created_at');

        return view('livewire.create-album');
    }
}
