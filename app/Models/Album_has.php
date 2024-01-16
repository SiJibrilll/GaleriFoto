<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album_has extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'post_id'
    ];
}
