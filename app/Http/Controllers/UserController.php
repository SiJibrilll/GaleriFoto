<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function show(User $user) {
        return view('profile-page', [
            'user' => $user
        ]);
    }
}
