<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheaterReview extends Model
{
    use HasFactory;

  protected $fillable = [
    'theater_id',
    'screen_number',
    'seat_number',
    'viewing_date',
    'review',
];

   protected $dates = ['viewing_date'];

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}