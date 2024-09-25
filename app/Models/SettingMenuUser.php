<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMenuUser extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'setting_menu_user';

    // Primary key dari tabel, sesuai dengan skema (bukan auto-increment)
    protected $primaryKey = 'no_setting';


    // Field yang dapat diisi melalui form
    protected $fillable = [
        'no_setting',
        'id_jenis_user',
        'menu_id',
        'create_by',
    ];

    // Relasi ke tabel `jenis_user` (many-to-one)
    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user', 'id_jenis_user');
    }

    // Relasi ke tabel `menus` (many-to-one)
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
}
