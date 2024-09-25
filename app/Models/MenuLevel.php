<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuLevel extends Model
{
    use HasFactory;

    protected $table = 'menu_levels';

    // Primary key dari tabel, sesuai dengan skema (bukan auto-increment)
    protected $primaryKey = 'id_level';

    // Menandakan bahwa primary key bukan integer (karena menggunakan string)
    public $incrementing = false;

    // Field yang dapat diisi melalui form
    protected $fillable = [
        'id_level',
        'level',
        'create_by',
    ];
}
