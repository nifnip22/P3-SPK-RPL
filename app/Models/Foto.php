<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul_foto',
        'deskripsi_foto',
        'lokasi_file',
        'album_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function album() {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function likeFoto() {
        return $this->hasMany(LikeFoto::class);
    }

    public function komentarFoto() {
        return $this->hasMany(KomentarFoto::class);
    }
}
