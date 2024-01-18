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
    function saveToNew() {
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
    function saveToAlbum($id) {
        if (!Auth::check()) {
            return;
        }

        // get users album where id matches, and attach
        Auth()->user()->albums->where('id', $id)->first()->posts()->attach($this->post);

        $this->saved = true;
    }

    // -- unsave a post
    function unsave() {
        if (!Auth::check()) {
            return;
        }
        
        // get user's albums
        $albums = Auth()->user()->albums;

        // for every album, detach the relationship
        foreach ($albums as $album) {
            $album->posts()->detach($this->post->id);
        }
            
        $this->saved = false;
        
    }


    public function render()
    {   

        $this->albums = Auth()->user()->albums->sortByDesc('created_at');

        return view('livewire.create-album');
    }
}
