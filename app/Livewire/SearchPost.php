<?php

namespace App\Livewire;

use Livewire\Component;

class SearchPost extends Component
{
    public $filter;

    public function render()
    {
        return view('livewire.search-post');
    }
}
