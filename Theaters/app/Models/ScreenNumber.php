<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScreenNumber extends Model
{
    protected $fillable = ['theater_id', 'screen_number'];

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }
}