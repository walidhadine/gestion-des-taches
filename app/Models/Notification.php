<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'titre',
        'contenu',
        'lien',
        'vue',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'vue' => 'boolean',
            'data' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsRead()
    {
        $this->update(['vue' => true]);
    }
}

