<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'overview',
        'poster_path',
        'vote_average',
        'release_date',
        'popularity',
        'original_language',
        'path',
    ];
}
