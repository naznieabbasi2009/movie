<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title' , 'movie_id' , "image"  , "status"];

    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
