<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheaterReview extends Model
{
    use HasFactory;
    
     protected $fillable = ['theater_id', 'review'];

    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id');
    }
}
