<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'user_id',
        'tanggal',
        'deskripsi',
        'nilai',
        'bukti',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
