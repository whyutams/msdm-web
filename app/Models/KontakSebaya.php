<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakSebaya extends Model
{
    protected $fillable = [
        'name',
        'description',
        'number',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
