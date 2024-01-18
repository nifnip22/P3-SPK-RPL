<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foto_id',
        'isi_komentar',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function foto() {
        return $this->belongsTo(Foto::class, 'foto_id');
    }
}
