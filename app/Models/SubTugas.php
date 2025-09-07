<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'urutan',
        'jenis',
        'content',
        'file_type',
        'file_path',
        'link',
        'tugas_id',
        'created_by',
        //'updated_by',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
