<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable = ['theater_name', 'address'];

    public function screenNumbers()
    {
        return $this->hasMany(ScreenNumber::class);
    }
    
    public function reviews()
{
    return $this->hasMany(TheaterReview::class);
}
}