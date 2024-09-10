<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
         'id', 'title', 'date', 'time', 'genre', 'director', 'cast', 'story', 'poster_uri'
    ];
    
    public function reviews()
{
    return $this->hasMany(MovieReview::class);
}

    public $incrementing = false; // IDは自動増分しない

    public $timestamps = false; // created_at と updated_at を使用しない
}