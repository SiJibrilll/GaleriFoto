<?php

namespace App\Http\Controllers;

use App\Models\Tmp_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TmpImageController extends Controller
{
    function create(Request $request): string
    {

        if (!$request->hasFile('image')) {
            return 'ERROR';
        }
        $image = $request->file('image')[0];
        $filename = uniqid('image-', true);
        $folder = uniqid('folder-', true);
        $image->storeAs('public/images/tmp/' . $folder, $filename);


        $tmp = Tmp_image::create([
            'folder' => $folder,
            'image' => $filename
        ]);

        return $tmp->id;
    }

    function delete()
    {
        $tmpImage = Tmp_image::where('image', request()->getContent())->first();
        if ($tmpImage) {
            Storage::deleteDirectory('public/images/tmp/' . $tmpImage->folder);
            $tmpImage->delete();
        }

        return response()->noContent();
    }

    function load(Request $request)
    {
    }
}
