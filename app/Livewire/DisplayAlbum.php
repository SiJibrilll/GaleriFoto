<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DisplayAlbum extends Component
{

    public $amount = 10;
    public $loads = 0;
    public $albums = [];

    function loadMore()
    {
       $this->loads++;
    }

    public function render()
    {

        $newAlbums = Auth()->user()->albums;


         // -- quarry all of the post's image
       foreach ($newAlbums as $album) {
        array_push($this->albums, [$album->id, $album->posts[0]->images[0]->image, $album->title]);
       }

        return view('livewire.display-album', ['album' => $this->albums]);
    }
}
