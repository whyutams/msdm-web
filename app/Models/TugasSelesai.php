<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasSelesai extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_id',
        'materi_id',
        'user_id',
    ];

    public function materi()
    {
        return $this->belongsTo(SubTugas::class, 'materi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }
}
