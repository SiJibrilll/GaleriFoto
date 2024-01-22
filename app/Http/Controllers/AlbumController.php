<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    function index() {
        return view('albums');
    }

    function show(Album $album) {

        return view('show-album', [
            'album' => $album->id
        ]);
    }
}
