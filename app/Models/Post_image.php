<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'post_id'
    ];

    function posts() {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
