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
    // TODO we gotta rework the whole album system fr fr
    // code to show if a post has been saved by a user, could be used for styling buttons
    // dd($post->albums->contains('user_id', Auth()->user()->id))

    // TODO 1-feb-2024 : where getting somewhere, now we just gotta decide what to do on empty albums
    // should we delete it here if the removed post was the last post for the album?
    // or should we just keep an empty album with a place holder and let users delete it from the album menu instead?

    // TODO 4 feb 2024 :
    // finish the save to new album

    // ACCOMPLISHMENTS :
    // ive successfully made the save button able to save posts to album, and unsave the post if the post has already been saved there.
    // unsave function could be depecrated soon due to achivement no-1
    // save to album is done alongside it's style, hopefully no fuckups will happen


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
