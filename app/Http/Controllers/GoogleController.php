<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    function redirect() {
        return Socialite::driver('google')->redirect(); // redirect user to SSO page
    }

    function callback() {
        $googleUser =  Socialite::driver('google')->stateless()->user(); // get account data

        try{ // lets try creating a user
            DB::transaction(function() use($googleUser) {
                $user = User::updateOrCreate([
                    'google_id' => $googleUser->id, // user with this google id exist? then simply return
                ], [
                    'username' => $googleUser->name, // else? create a new user
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'image' => $googleUser->getAvatar()
                ]);
        
                Auth::login($user, true); // login the user
            });

            return redirect('/');
        }
        catch (\Throwable $e){
            dd('error!! ' . $e);
        }
    }
}
