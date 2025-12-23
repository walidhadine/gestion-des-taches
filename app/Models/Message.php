<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'expediteur_id',
        'destinataire_id',
        'task_id',
        'sujet',
        'message',
        'lu',
        'is_archived_exp',
        'is_archived_dest',
    ];

    protected function casts(): array
    {
        return [
            'lu' => 'boolean',
            'is_archived_exp' => 'boolean',
            'is_archived_dest' => 'boolean',
            'date_envoi' => 'datetime',
        ];
    }

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function fichiers()
    {
        return $this->hasMany(Fichier::class);
    }
}

