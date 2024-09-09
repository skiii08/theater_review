<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $table = 'theater_reviews';
    
    protected $fillable = [
        'theater_id',
        'screen_number',
        'seat_number',
        'viewing_date',
        'review',
        'user_id'
    ];
    
    public function theater()
{
    return $this->belongsTo(Theater::class);
}
}
