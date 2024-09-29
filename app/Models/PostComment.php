<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $table = 'post_comments';
    protected $primaryKey = 'comment_id';

    public $timestamps = false;
    protected $fillable = [
        'comment_id',
        'post_id',
        'user_id',
        'comment_text',
        'comment_image',
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

    // In Comment.php model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Make sure 'user_id' is the foreign key in the comments table
    }

}
