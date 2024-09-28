<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;

    protected $table = 'post_likes';
    protected $primaryKey = 'like_id';

    protected $fillable = [
        'like_id',
        'post_id',
        'user_id',
        'create_by',
        'create_date',
        'delete_mark',
        'update_by',
        'update_date',
    ];

    // Relasi dengan posting
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }
}
