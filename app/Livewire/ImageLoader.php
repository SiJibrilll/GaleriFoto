<?php

namespace App\Livewire;

use Livewire\Component;

class ImageLoader extends Component
{
    public $isLoaded = false;
    public $url;
    public $imgKey;

    public function render()
    {
        return view('livewire.image-loader');
    }
}
