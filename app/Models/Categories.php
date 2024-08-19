<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    // Relasi dengan model Buku
    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_kategori', 'id_kategori');
    }
}
