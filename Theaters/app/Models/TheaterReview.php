<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheaterReview extends Model
{
    use HasFactory;

 protected $fillable = [
    'theater_id', 'user_id', 'viewing_date', 'screen_number', 'seat_number', 'image_url', 'review'
];
    
    protected $attributes = [
        'image_url' => 'https://thumb.ac-illust.com/39/3920178d66157451930de97cc5431a64_t.jpeg',
    ];

   protected $dates = ['viewing_date', 'created_at', 'updated_at'];

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getScreenNumberAttribute($value)
    {
        return $value === null ? '未入力' : $value;
    }

    public function getSeatNumberAttribute($value)
    {
        return $value === null ? '未入力' : $value;
    }

    public function getReviewAttribute($value)
    {
        return $value === null ? '未入力' : $value;
    }
}