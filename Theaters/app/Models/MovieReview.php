<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'user_id',
        'movie_rating',
        'movie_review',
    ];

    protected $casts = [
        'movie_rating' => 'float',
    ];

    public function movie()
{
    return $this->belongsTo(Movie::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getMovieTitleAttribute()
{
    return $this->movie ? $this->movie->title : 'Unknown Movie';
}
}