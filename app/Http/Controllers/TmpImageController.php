<?php

namespace App\Http\Controllers;

use App\Models\Tmp_image;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TmpImageController extends Controller
{

    function create(Request $request): string
    {
        // TODO validation only checks for files in the front end, it doesnt check it here in the back end. will fix later
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
