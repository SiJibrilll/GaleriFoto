<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    function show(User $user) {
        View::share('title', 'profile');
        return view('profile', [
            'user' => $user
        ]);
    }
}
