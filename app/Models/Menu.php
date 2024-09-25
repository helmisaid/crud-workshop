<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'menu_id';
    protected $fillable = [
     'menu_name', 'menu_link', 'menu_icon', 'level_id', 'parent_id', 'create_by'
    ];

}
