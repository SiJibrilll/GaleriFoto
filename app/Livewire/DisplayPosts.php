<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class DisplayPosts extends Component
{
    #[Reactive]
    public $filter;
    
    public $user;
    public $tag;
    public $album;

    public $amount = 10;
    public $loads = 0;
    public $posts = [];

    // extremely hacky and i dont like it, im sorry to experts who had witness this but im running out of time
    public $columns = [];
    public $index = 0;
    public $column = 2;
    public $previousCol = 0;

    function loadMore()
    {
       $this->loads++;

       if ($this->filter == null && $this->tag == null) { // if there were no filters or tags applied, then show newest posts
            $newPosts =  Post::orderBy('created_at', 'desc')->offset($this->amount * $this->loads)->limit($this->amount)->get();
        
        } 
        
        if (isset($this->filter)){ // if there were filters, then query accordingly
            $newPosts = Post::where('title', 'like', '%'. $this->filter . '%')->orWhere('description', 'like', '%'. $this->filter . '%')
            ->offset($this->amount * $this->loads)->limit($this->amount)->get();
        }

        if (isset($this->tag)){ // if there were tags, then query accordingly
                $newPosts = Tag::where('name', $this->tag)->first()->posts;
            }

            if (isset($this->album)){ // if there were an album id, then query accordingly
                $album = Album::find($this->album);
                if ($album->users->id != Auth()->user()->id) {
                    return redirect('/');
                }

                $newPosts = $album->posts;
            }

            if (isset($this->user)) {
                $newPosts = User::find($this->user)->posts;
            }


        // -- quarry all of the post's image
        foreach ($newPosts as $post) {
            array_push($this->posts, [$post->id, $post->images[0]->image]);
        }
    }

    function addToColumn() {
        foreach ($this->columns as $column) {
            for ($i = 0; $i < count($this->posts) / $this->column; $i++) {
                array_push($column, $this->posts[$i]);
            }
        }
    }

    function changeColumn($column) {
        $this->column = $column;
        $this->columns = [];
        $columnOffset = 0;
        $imagesInColumn = floor(count($this->posts) / $column);

        for ($columnIndex = 0; $columnIndex < $column; $columnIndex++) {
            $array = [];
            for ($i = 0; $i < $imagesInColumn; $i++) {
                if (isset($this->posts[$columnOffset])) {
                    array_push($array, $this->posts[$columnOffset]);
                }
                $columnOffset += 1;
            }

            
            array_push($this->columns, $array);
        }
    }

    public function updateLayout($column)
    {
        if ($column != $this->previousCol) {
            $this->changeColumn($column);
        } else {
            $this->addToColumn();
        }

        $this->reset('posts');
    }
    
    function mount() {
        $this->loadMore();
    }


    public function render()
    {
        $this->updateLayout($this->column);
        return view('livewire.display-posts');
    }
}
