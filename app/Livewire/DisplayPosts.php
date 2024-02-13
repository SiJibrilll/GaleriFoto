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

    function loadMore()
    {
       $this->loads++;
    }

    public function updateLayout($isSmallScreen)
    {
        // Update component data or logic based on the screen size flag
        // dd($isSmallScreen);
    }
    

    public function render()
    {
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
       

        return view('livewire.display-posts', ['posts' => $this->posts]);
    }
}
