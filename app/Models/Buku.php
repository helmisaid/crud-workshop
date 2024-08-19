<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';
    protected $primaryKey = 'idbuku';

    protected $fillable = [
        'kode_buku',
        'judul_buku',
        'pengarang',
        'id_kategori',
    ];

    // Relasi dengan model Kategori
    public function kategori()
    {
        return $this->belongsTo(Categories::class, 'id_kategori', 'id_kategori');
    }
}
