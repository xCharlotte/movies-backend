<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteMovieUser extends Model
{
    public $table = 'favorite_movie_user';

    protected $fillable = [
        'movie_id',
        'user_id',
      ];
      
      public function user(): BelongsTo 
      {
        return $this->belongsTo(User::class);
      }
      
      public function movie(): BelongsTo 
      {
        return $this->belongsTo(Movie::class);
      }
}
