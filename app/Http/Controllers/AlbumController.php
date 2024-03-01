<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    function index() {
        return view('albums');
    }

    function show(Album $album) {

        return view('show-album', [
            'title' => $album->title,
            'album' => $album->id
        ]);
    }

    function delete(Album $album) {
        if (Auth()->user()->id != $album->users->id) {
            return redirect('/users/show/' . Auth()->user()->id);
        }

        $album->delete();
        
        return redirect('/users/show/' . Auth()->user()->id);
    }
}
