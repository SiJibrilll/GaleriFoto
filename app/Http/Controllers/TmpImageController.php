<?php

namespace App\Http\Controllers;

use App\Models\Tmp_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TmpImageController extends Controller
{
    // TODO we need to remake our whole post image uploading worflow so that we dont need to have folders for each images anymore

    function create(Request $request): string
    {

        if (!$request->hasFile('image')) {
            return 'ERROR';
        }

        $image = $request->file('image')[0];
        $filename = uniqid('image-', true) . '.' . $image->extension();
        $image->storeAs('public/images/tmp/', $filename);

       

        $tmp = Tmp_image::create([
            'image' => $filename
        ]);

        return $tmp->id;
    }

    function delete()
    {
        $tmpImage = Tmp_image::where('image', request()->getContent())->first();
        if ($tmpImage) {
            Storage::delete('public/images/tmp/' . $tmpImage->image);
            // Storage::deleteDirectory('public/images/tmp/' . $tmpImage->folder);
            $tmpImage->delete();
        }

        return response()->noContent();
    }

    function load(Request $request)
    {
    }
}
