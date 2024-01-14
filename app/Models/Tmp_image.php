<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tmp_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder',
        'image'
    ];
}
