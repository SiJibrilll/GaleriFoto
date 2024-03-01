<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class RegisterLivewire extends Component
{
    use WithFileUploads;

    
    public $step = 1; // for the sake of testing i will be hard coding this into diffrent steps, MAKE SURE to change it back to 1

    public $email;
    public $password;
    public $username;
    

    function signUpWithEmail() {
        $this->step = 2;
    }

    function register(){
        $this->dispatch('register', message: 'Image uploaded');
        $validated = $this->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $validated['username'] = explode("@", $validated['email'])[0];

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        Auth::login($user, true); // login the user

        $this->step = 3;
    }


    public function render()
    {

        return view('livewire.register-livewire');
    }
}
