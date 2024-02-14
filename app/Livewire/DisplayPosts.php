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

    // -- properties for column display
    public $columns = [];
    public $column;
    public $serve = true;

    function endServe() {
        $this->serve = false;
    }

    // get post from database
    protected function getPost() {
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

        //TODO Problem diagnosed : there is no offseting on users and album so the system infinitely grabs all posts from them with no end.

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

    // load more posts
    function loadMore()
    {
       $this->loads++;

       $this->getPost();
       $this->servePostToColumn($this->column);
    }

    // to refresh the array of columns to fit diffrent screens
    protected function createColumns($newColumn) {
        $this->reset('columns');
        for ($i = 0; $i < $newColumn; $i++) {
            array_push($this->columns, []);
        }
    }

    // this function will fit posts quarried from database to the columns
    protected function servePostToColumn($column) {
        $postIndex = 0;
        $division = count($this->posts) / $column;
        for ($colIndex = 0; $colIndex < $column; $colIndex++) {
            for ($i = 0; $i < $division; $i++) {
                if (isset($this->posts[0])) {
                    array_push($this->columns[$colIndex], $this->posts[0]);
                    array_shift($this->posts);
                }
            }
        }
        $this->reset('posts');
    }

    public function updateLayout($column)
    {
        $this->reset('loads');
        $this->createColumns($column);
        $this->getPost();
        $this->servePostToColumn($column);
        $this->column = $column;
    }

    
    
    // run once on mount
    function mount() {
        $defaultColumns = 2;
        $this->getPost();
        $this->createColumns($defaultColumns);
        $this->servePostToColumn($defaultColumns);
        $this->column = $defaultColumns;
    }

    public function render()
    {
        return view('livewire.display-posts');
    }
}
