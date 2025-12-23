<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model
{
    use HasFactory;

    protected $table = 'conversation_messages';

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'date_envoi' => 'datetime',
        ];
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}

