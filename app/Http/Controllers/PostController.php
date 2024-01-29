<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tmp_image;
use App\Models\Post_image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    // -- show all post
    function index() {
        $posts = Post::all();

        return view('home', [
            'posts' => $posts
        ]);
    }

    // -- show create form
    function create()
    {
        return view('create-post');
    }

    // -- store post
    function store(Request $request)
    {
        // validasi data
        $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);

    
        $post = Post::create([
            'user_id' => Auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // simpan tiap gambar yang disertakan
        foreach (($request->image ?? array()) as $image) {
            if (null == $image || !is_numeric($image)) {
                $post->delete();
                return redirect('/posts/create')->withInput()->withErrors(['image' => 'Image required']);
            }

            $tmp = Tmp_image::find($image);
            Storage::copy('public/images/tmp/' . $tmp->folder . '/' . $tmp->image, 'public/images/postImage/' . $tmp->folder . '/' . $tmp->image);
            Post_image::create([
                'image' => $tmp->folder . '/' . $tmp->image,
                'post_id' => $post->id
            ]);
            // -- hapus tmp image
            Storage::deleteDirectory('public/images/tmp/' . $tmp->folder);
            $tmp->delete();
        }

        
        // -- create and attach tags
        if (isset($request->tags)) {
            // seperate the tags into diffrent strings based on white space
            $tags = explode(' ', $request->tags);

            // store or find each tags and attach it to post
            foreach ($tags as $tag) {
                $post->tags()->attach(Tag::firstOrCreate(['name' => $tag]));
            }
        }

        return redirect('/posts/show/' . $post->id);
    }

    // -- show one post
    function show(Post $post) {
        return view('show-post', [
            'post' => $post
        ]);
    }

    // -- show edit form
    function edit(Post $post) {
        // if user doesnt own this post, return with error
        // TODO add error msg
        if (Auth()->user()->id != $post->user->id) {
            return redirect('/posts/show/' . $post->id);
        }


        return view('edit-post', [
            'post' => $post
        ]);
    }

    function update(Post $post, Request $request) {
        // validasi data
        $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);

        // update post
        $post->update($request->all());

        // hapus semua gambar lama
        foreach ($post->images as $image) {
            Storage::deleteDirectory('images/postImage/'. dirname($image->image));
            $image->delete();
        }

        // simpan tiap gambar yang disertakan
        foreach (($request->image ?? array()) as $image) {
            if (null == $image || !is_numeric($image)) {
                $post->delete();
                return redirect('/posts/create')->withInput()->withErrors(['image' => 'Image required']);
            }

            $tmp = Tmp_image::find($image);
            Storage::copy('public/images/tmp/' . $tmp->folder . '/' . $tmp->image, 'public/images/postImage/' . $tmp->folder . '/' . $tmp->image);
            Post_image::create([
                'image' => $tmp->folder . '/' . $tmp->image,
                'post_id' => $post->id
            ]);
            // -- hapus tmp image
            Storage::deleteDirectory('public/images/tmp/' . $tmp->folder);
            $tmp->delete();
        }

        return redirect('/posts/show/'. $post->id);
    }

    function delete(Post $post) {
        if (!Auth()->user()->hasRole('admin') && $post->user->id != Auth()->user()->id) {
            return;
        }

        // hapus semua gambar lama
        foreach ($post->images as $image) {
            Storage::deleteDirectory('images/postImage/'. dirname($image->image));
            $image->delete();
        }

        $post->delete();
        
        return redirect('/');
    
    }

    function image(Post $post) {
        return view('show-image', [
            'post' => $post
        ]);
    }
}
