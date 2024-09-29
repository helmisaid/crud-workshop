<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'message_id',
        'sender',
        'message_reference',
        'subject',
        'message_text',
        'message_status',
        'no_mk',
        'create_by',
        'delete_mark',
        'update_by'
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a UUID for the message_id when creating a new message
        static::creating(function ($message) {
            if (empty($message->message_id)) {
                $message->message_id = (string) Str::uuid(); // Generate a UUID
            }
        });
    }

    // In App\Models\Message.php
    public function recipients()
    {
        return $this->hasMany(MessageTo::class, 'message_id', 'message_id');
    }


    public function senderMessages()
    {
        return $this->hasMany(MessageTo::class, 'to', 'sender');
    }


    // Relationship with MessageKategori
    public function category()
    {
        return $this->belongsTo(MessageKategori::class, 'no_mk', 'no_mk');
    }

    // Relationship with MessageDokumen
    public function documents()
    {
        return $this->hasMany(MessageDokumen::class, 'message_id', 'message_id');
    }
}
