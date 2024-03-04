<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // TODO just save the user's custom pfp with assets() . filename so we can support both full google pfp urls and urls stored in our system

    function show(User $user) {
        View::share('title', 'profile');
        return view('profile', [
            'user' => $user
        ]);
    }

    function edit() {
        return view('edit-user');
    }
}
