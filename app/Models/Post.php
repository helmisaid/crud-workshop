<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';

    protected $fillable = [
        'post_id',
        'sender',
        'message_text',
        'post_image',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    // Relasi dengan komentar
    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id', 'post_id');
    }

    // Relasi dengan like
    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id', 'post_id');
    }

}
