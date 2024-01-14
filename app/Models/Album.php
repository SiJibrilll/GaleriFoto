<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    function posts() {
        return $this->belongsToMany(Post::class, 'album_has', 'album_id', 'post_id');
    }
}
