<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function posts() 
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

}
