<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfileLivewire extends Component
{

    public $username;

    function save() {
        $this->validate([
            'username' => 'required|string|min:3|max:25'
        ]);

        $user = User::find(Auth()->user()->id);
        $user->username = $this->username;
        $user->save();

        $this->dispatch('flash', message: 'Profile saved');

    }

    public function render()
    {
        $this->username = User::find(Auth()->user()->id)->username;
        return view('livewire.edit-profile-livewire');
    }
}
