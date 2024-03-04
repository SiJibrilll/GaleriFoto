<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class EditPfpLivewire extends Component
{

    use WithFileUploads;
    // TODO path to our storage system beacuse funky laravel starts this path at storage/app -> Storage::disk('local')->exists('/public/images/profileImage/')

    #[Validate('image|max:1024')]
    public $newImage;


    function updatedNewImage() {
        $this->validate([
            'newImage' => 'image'
        ]);

        // check if user's image is in our local system
        $url = Auth()->user()->image;
        $urlArray = explode('/', $url);
        $file = $urlArray[count($urlArray) - 1];


        if (Storage::disk('local')->exists('/public/images/profileImage/'. $file)) {
            Storage::delete('public/images/profileImage/' . $file); // if it does, then delete the file
        }

        // -- lets create a unique file name, and store it
        $filename = uniqid('image-', true) . '.' . $this->newImage->extension();
        $this->newImage->storeAs(path: "public/images/profileImage", name: $filename);

        // -- now save the new image path to users db
       $user = User::find(Auth()->user()->id);
       $user->image = asset("storage/images/profileImage/" . $filename);
       $user->save();

       // -- now we shot the flash msg and change the pfp on nav bar
       $this->dispatch('flash', message: 'Image uploaded');
       $this->dispatch('changePfp', message: $user->image);
    }

    public function render()
    {        
        $image = User::find(Auth()->user()->id);
        return view('livewire.edit-pfp-livewire', [
            'image' => $image->image
        ]);
    }
}
