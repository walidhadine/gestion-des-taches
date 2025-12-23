<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;

    protected $table = 'fichiers';

    protected $fillable = [
        'nom_original',
        'nom_stockage',
        'chemin',
        'type_mime',
        'taille',
        'uploaded_by',
        'task_id',
        'message_id',
    ];

    protected function casts(): array
    {
        return [
            'taille' => 'integer',
            'uploaded_at' => 'datetime',
        ];
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}

