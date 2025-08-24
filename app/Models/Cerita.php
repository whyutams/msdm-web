<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cerita extends Model
{
    protected $fillable = [
        'cerita',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
