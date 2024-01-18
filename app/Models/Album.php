<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_album',
        'deskripsi',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function foto() {
        return $this->hasMany(Foto::class);
    }
}
