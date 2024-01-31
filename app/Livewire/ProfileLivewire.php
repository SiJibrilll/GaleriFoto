<?php

namespace App\Livewire;

use Livewire\Component;

class ProfileLivewire extends Component
{
    #[Locked] 
    public $selected = 'posts';
    
    public $user;

    function select($selection) {
        $this->selected = $selection;
    }

    public function render()
    {
        return view('livewire.profile-livewire');
    }
}
